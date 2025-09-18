
<?php
class Games {
    public $db;

    public function __construct() {
        $this->db = dbConn(); 
    }

    public function getGames($lang = 'en')
    {
        // Validate language
        $lang = in_array($lang, ['en', 'bn']) ? $lang : 'en';

        // Select language-specific fields
        $name_field = $lang === 'en' ? 'name' : 'name_bn';
        $description_field = $lang === 'en' ? 'description' : 'description_bn';
        $meta_text_field = $lang === 'en' ? 'meta_text' : 'meta_text_bn';
        $meta_desc_field = $lang === 'en' ? 'meta_desc' : 'meta_desc_bn';
        $meta_keyword_field = $lang === 'en' ? 'meta_keyword' : 'meta_keyword_bn';
        $query = "SELECT p.id, p.slug, p.$name_field AS name, p.image, 
                     p.$description_field AS description, p.$description_field AS description, p.$meta_desc_field AS meta_desc,
                     p.game_link, p.category_id, p.created_at, 
                     p.$meta_text_field AS meta_text, 
                     c.name AS category_name 
              FROM games p
              JOIN categories c ON p.category_id = c.id 
              ORDER BY p.created_at DESC";

        try {
            $stmt = $this->db->query($query);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error fetching games: " . $e->getMessage());
            return [];
        }
    }


    public function getGameById($id, $lang = 'en') {
        // Validate language
        $lang = in_array($lang, ['en', 'bn']) ? $lang : 'en';
        
        // Select language-specific fields
        $name_field = $lang === 'en' ? 'name' : 'name_bn';
        $description_field = $lang === 'en' ? 'description' : 'description_bn';
        $meta_text_field = $lang === 'en' ? 'meta_text' : 'meta_text_bn';
        $query = "SELECT 
            p.id, 
            p.$name_field AS name, 
            p.image, 
            p.$description_field AS description, 
            p.meta_desc, 
            p.meta_keyword,
            p.meta_desc_bn, 
            p.meta_keyword_bn,
            p.game_link, 
            p.category_id, 
            p.created_at, 
            p.$meta_text_field AS meta_text, 
            c.name AS category_name 
          FROM games p
          JOIN categories c ON p.category_id = c.id 
          WHERE p.id = :id 
          LIMIT 1";
        try {
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error fetching game by ID: " . $e->getMessage());
            return false;
        }
    }
    public function getGameBySlug($slug, $lang = 'en')
    {
        // Validate language
        $lang = in_array($lang, ['en', 'bn']) ? $lang : 'en';

        // Select language-specific fields
        $name_field = $lang === 'en' ? 'name' : 'name_bn';
        $description_field = $lang === 'en' ? 'description' : 'description_bn';
        $meta_text_field = $lang === 'en' ? 'meta_text' : 'meta_text_bn';
        $meta_desc_field = $lang === 'en' ? 'meta_desc' : 'meta_desc_bn';
        $meta_keyword_field = $lang === 'en' ? 'meta_keyword' : 'meta_keyword_bn';
        $query = "SELECT p.id, p.$name_field AS name, p.image, p.$description_field AS description, p.$meta_desc_field AS meta_desc, 
            p.$meta_keyword_field AS meta_keyword,
                     p.game_link, p.category_id, p.created_at, p.$meta_text_field AS meta_text, 
                     c.name AS category_name 
              FROM games p
              JOIN categories c ON p.category_id = c.id 
              WHERE p.slug = :slug 
              LIMIT 1";

        try {
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':slug', $slug, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error fetching game by Slug: " . $e->getMessage());
            return false;
        }
    }

    public function getRelatedGames($gameId, $categoryId, $limit = 4, $lang = 'en')
    {
        // Validate language
        $lang = in_array($lang, ['en', 'bn']) ? $lang : 'en';

        // Select language-specific fields
        $name_field = $lang === 'en' ? 'name' : 'name_bn';
        $description_field = $lang === 'en' ? 'description' : 'description_bn';
        $meta_text_field = $lang === 'en' ? 'meta_text' : 'meta_text_bn';

        $query = "SELECT p.id, p.slug, p.$name_field AS name, p.image, 
                     p.$description_field AS description, 
                     p.game_link, p.category_id, p.created_at, 
                     p.$meta_text_field AS meta_text, 
                     c.name AS category_name
              FROM games p
              JOIN categories c ON p.category_id = c.id 
              WHERE p.id != :id AND p.category_id = :category_id 
              ORDER BY RAND() 
              LIMIT :limit";

        try {
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $gameId, PDO::PARAM_INT);
            $stmt->bindParam(':category_id', $categoryId, PDO::PARAM_INT);
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error fetching related games: " . $e->getMessage());
            return [];
        }
    }



    public function getPopularGames($limit = 6, $lang = 'en')
    {
        // Validate language
        $lang = in_array($lang, ['en', 'bn']) ? $lang : 'en';

        // Select language-specific fields
        $name_field = $lang === 'en' ? 'name' : 'name_bn';
        $description_field = $lang === 'en' ? 'description' : 'description_bn';
        $meta_text_field = $lang === 'en' ? 'meta_text' : 'meta_text_bn';

        $query = "SELECT p.id, p.$name_field AS name, p.image, p.$description_field AS description, 
                     p.game_link, p.category_id, p.created_at, p.$meta_text_field AS meta_text, 
                     p.slug, 
                     c.name AS category_name 
              FROM games p
              JOIN categories c ON p.category_id = c.id 
              ORDER BY p.created_at DESC
              LIMIT :limit";
        try {
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error fetching popular games: " . $e->getMessage());
            return [];
        }
    }


    public function searchgames($query, $lang = 'en') {
        // Validate language
        $lang = in_array($lang, ['en', 'bn']) ? $lang : 'en';
        
        // Select language-specific fields
        $name_field = $lang === 'en' ? 'name' : 'name_bn';
        $description_field = $lang === 'en' ? 'description' : 'description_bn';
        $meta_text_field = $lang === 'en' ? 'meta_text' : 'meta_text_bn';

        $sql = "SELECT p.id, p.$name_field AS name, p.image, p.$description_field AS description, 
                       p.game_link, p.category_id, p.created_at, p.$meta_text_field AS meta_text, 
                       c.name AS category_name 
                FROM games p
                JOIN categories c ON p.category_id = c.id
                WHERE p.$name_field LIKE :query OR c.name LIKE :query";
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute(['query' => '%' . $query . '%']);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error searching games: " . $e->getMessage());
            return [];
        }
    }
    // Utility: Generate slug from text
    private function generateSlug($text)
    {
        // Convert to lowercase, remove special chars, replace spaces with hyphens
        $slug = strtolower(trim($text));
        $slug = preg_replace('/[^a-z0-9]+/i', '-', $slug);
        $slug = trim($slug, '-');
        return $slug;
    }

    public function createGames($name, $image, $description, $link, $category_id, $meta_text, $name_bn, $description_bn, $meta_text_bn, $meta_desc, $meta_keyword, $meta_desc_bn, $meta_keyword_bn, $slug = null)
    {
        // Auto-generate slug from English name if not provided
        $slug = $slug ?: $this->generateSlug($name);

        $data = [
            'name' => $name,
            'slug' => $slug,
            'image' => $image,
            'description' => $description,
            'game_link' => $link,
            'category_id' => $category_id,
            'meta_text' => $meta_text,
            'name_bn' => $name_bn,
            'description_bn' => $description_bn,
            'meta_text_bn' => $meta_text_bn,
            'meta_desc' => $meta_desc,
            'meta_keyword' => $meta_keyword,
            'meta_desc_bn' => $meta_desc_bn,
            'meta_keyword_bn' => $meta_keyword_bn,
            
        ];
        return dbInsert('games', $data);
    }

    public function updateGame($id, $name, $image, $description, $game_link, $category_id, $meta_text, $name_bn, $description_bn, $meta_text_bn, $meta_desc, $meta_keyword, $meta_desc_bn, $meta_keyword_bn, $slug = null)
    {
        if (!$this->getGameById($id)) {
            return false;
        }

        // Auto-generate slug from English name if not provided
        $slug = $slug ?: $this->generateSlug($name);

        $data = [
            'name' => $name,
            'slug' => $slug,
            'image' => $image,
            'description' => $description,
            'game_link' => $game_link,
            'category_id' => $category_id,
            'meta_text' => $meta_text,
            'name_bn' => $name_bn,
            'description_bn' => $description_bn,
            'meta_text_bn' => $meta_text_bn,
            'meta_desc' => $meta_desc,
            'meta_keyword' => $meta_keyword,
            'meta_desc_bn' => $meta_desc_bn,
            'meta_keyword_bn' => $meta_keyword_bn,

        ];
        return dbUpdate('games', $data, "id=" . $this->db->quote($id));
    }

    // Delete a product (unchanged)
    public function deleteGame($id) {
        return dbDelete('games', "id=" . $this->db->quote($id));
    }
}
?>