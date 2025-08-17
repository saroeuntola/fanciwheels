<?php
class Announcement
{
    private $db;

    public function __construct()
    {
        $this->db = dbConn(); 
    }

    // CREATE a new announcement
    public function createAnnouncement($message, $link = null)
    {
        $data = [
            'message' => $message,
            'link'    => $link
        ];

        return dbInsert('announcements', $data);
    }

    // READ all announcements
    public function getAnnouncements()
    {
        return dbSelect('announcements', '*');
    }

    // READ a specific announcement by ID
    public function getAnnouncementByID($id)
    {
        $quotedId = $this->db->quote($id);
        $result = dbSelect('announcements', '*', "id=$quotedId");

        return ($result && count($result) > 0) ? $result[0] : null;
    }

    // UPDATE an announcement
    public function updateAnnouncement($id, $message, $link = null)
    {
        $announcement = $this->getAnnouncementByID($id);
        if (!$announcement) {
            return false; // Announcement doesn't exist
        }

        $data = [
            'message' => $message,
            'link'    => $link
        ];

        return dbUpdate('announcements', $data, "id=" . $this->db->quote($id));
    }

    // DELETE an announcement
    public function deleteAnnouncement($id)
    {
        $announcement = $this->getAnnouncementByID($id);
        if (!$announcement) {
            return false; // Announcement doesn't exist
        }

        return dbDelete('announcements', "id=" . $this->db->quote($id));
    }
}
?>
