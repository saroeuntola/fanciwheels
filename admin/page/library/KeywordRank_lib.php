<?php
class KeywordRank
{
    public $db;

    public function __construct()
    {
        try {
            $this->db = dbConn();
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    // Get all keywords
    public function getKeywords()
    {
        $stmt = $this->db->query("SELECT * FROM keywords");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Crawl Google for a single keyword
    public function crawlKeyword($keyword, $siteURL)
    {
        $searchEngine = "https://www.google.com/search?q=" . urlencode($keyword);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $searchEngine);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (compatible; KeywordRankBot/1.0; +http://".$siteURL.")");
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $result = curl_exec($ch);
        if (curl_errno($ch)) { 
            curl_close($ch); 
            return 0; 
        }
        curl_close($ch);

        if (empty($result)) return 0;

        $position = 0;
        $dom = new DOMDocument();
        if (@$dom->loadHTML($result)) {
            $links = $dom->getElementsByTagName('a');
            foreach ($links as $index => $link) {
                $href = $link->getAttribute('href');
                if (strpos($href, $siteURL) !== false) {
                    $position = $index + 1;
                    break;
                }
            }
        }
        return $position;
    }

    // Log rank in database (only once per day)
    public function logRank($keywordId, $rank)
    {
        // Delete old logs for this keyword
        $stmt = $this->db->prepare("DELETE FROM rank_logs WHERE keyword_id = :kid");
        $stmt->execute([':kid' => $keywordId]);

        // Insert new log
        $stmt = $this->db->prepare("INSERT INTO rank_logs (keyword_id, rank_value, log_date) VALUES (:kid, :rank, NOW())");
        $stmt->execute([
            ':kid' => $keywordId,
            ':rank' => $rank
        ]);
    }

    // Crawl all keywords
    public function crawlAll()
    {
        $keywords = $this->getKeywords();
        $status = [];
        foreach ($keywords as $kw) {
            $rank = $this->crawlKeyword($kw['keyword'], $kw['site_url']);
            $this->logRank($kw['id'], $rank); // old logs removed, only 1 entry per keyword
            $status[] = [
                'keyword' => $kw['keyword'],
                'rank' => $rank
            ];
        }
        return $status;
    }

    // Crawl a single keyword
    public function crawlSingleKeyword($keywordId)
    {
        $kw = $this->db->prepare("SELECT * FROM keywords WHERE id = :id");
        $kw->execute([':id' => $keywordId]);
        $kw = $kw->fetch(PDO::FETCH_ASSOC);
        if (!$kw) return null;

        $rank = $this->crawlKeyword($kw['keyword'], $kw['site_url']);
        $this->logRank($kw['id'], $rank); // old log removed
        return ['keyword' => $kw['keyword'], 'rank' => $rank];
    }

    // Get rank history for a keyword
    public function getRankHistory($keywordId)
    {
        $stmt = $this->db->prepare("SELECT rank_value, log_date FROM rank_logs WHERE keyword_id = :keyword_id ORDER BY log_date ASC");
        $stmt->execute([':keyword_id' => $keywordId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
