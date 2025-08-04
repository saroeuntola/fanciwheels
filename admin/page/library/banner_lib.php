<?php
class Banner {
    public $db;

    public function __construct() {
        $this->db = dbConn(); 
    }

    // Create a new Banner
    public function createBanner($title, $image, $link) {
        $data = [
            'title' => $title,
            'image' => $image,
            'link' => $link
        ];
        return dbInsert('banner', $data);
    }

    // READ all Banner
    public function getBanner()
    {
        return dbSelect('banner', '*');
    }

    // READ a specific Banner by ID
    public function getBannerById($id)
    {
        $quotedId = $this->db->quote($id);
        $result = dbSelect('banner', '*', "id=$quotedId");

        return ($result && count($result) > 0) ? $result[0] : null;
    }
    // Update a Banner
    public function updateBanner($id, $title, $image, $link) {
        if (!$this->getBannerById($id)) {
            return false; 
        }

        $data = [
            'title' => $title,
            'image' => $image,
            'link' => $link
        ];
        return dbUpdate('banner', $data, "id=" . $this->db->quote($id));
    }

    // Delete a product
    public function deleteBanner($id) {
        return dbDelete('banner', "id=" . $this->db->quote($id));
    }
}
?>
