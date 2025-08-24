<?php

include 'db.php';

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

    // Crawl Google for a single keyword (private)
    private function crawlKeyword($keyword, $siteURL)
    {
        $userAgents = [
            "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36",
            "Mozilla/5.0 (Macintosh; Intel Mac OS X 13_5) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.6 Safari/605.1.15",
            "Mozilla/5.0 (X11; Linux x86_64) Gecko/20100101 Firefox/119.0",
            "Mozilla/5.0 (iPhone; CPU iPhone OS 17_5 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.5 Mobile/15E148 Safari/604.1",
            "Mozilla/5.0 (Linux; Android 14; Pixel 8 Pro) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0 Mobile Safari/537.36"
        ];

        $randomUA = $userAgents[array_rand($userAgents)];
        $searchEngine = "https://www.google.com/search?q=" . urlencode($keyword);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $searchEngine);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, $randomUA);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $result = curl_exec($ch);
        if (curl_errno($ch)) { curl_close($ch); return 0; }
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

    // Log rank in database (private)
    private function logRank($keywordId, $rank)
    {
        $stmt = $this->db->prepare("INSERT INTO rank_logs (keyword_id, rank_value) VALUES (:keyword_id, :rank_value)");
        $stmt->execute([
            ':keyword_id' => $keywordId,
            ':rank_value' => $rank
        ]);
    }

    // Crawl all keywords (public)
    public function crawlAll()
    {
        $keywords = $this->getKeywords();
        $status = [];
        foreach ($keywords as $kw) {
            $rank = $this->crawlKeyword($kw['keyword'], $kw['site_url']);
            $this->logRank($kw['id'], $rank);
            $status[] = [
                'keyword' => $kw['keyword'],
                'rank' => $rank
            ];
        }
        return $status; // Return array for status display
    }

    // Crawl a single keyword (public wrapper)
    public function crawlSingleKeyword($keywordId)
    {
        $kw = $this->db->prepare("SELECT * FROM keywords WHERE id = :id");
        $kw->execute([':id' => $keywordId]);
        $kw = $kw->fetch(PDO::FETCH_ASSOC);
        if (!$kw) return null;

        $rank = $this->crawlKeyword($kw['keyword'], $kw['site_url']);
        $this->logRank($kw['id'], $rank);
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
