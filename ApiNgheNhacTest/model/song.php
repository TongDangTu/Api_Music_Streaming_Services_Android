<?php
class Song {
    private string $id;
    private string $name;
    private int $playedTime;
    private string $linkSong;
    private string $linkPicture;

    public function __construct($id, $name, $playedTime, $linkSong, $linkPicture) {
        $this->id = $id;
        $this->name = $name;
        $this->playedTime = $playedTime;
        $this->linkSong = $linkSong;
        $this->linkPicture = $linkPicture;
    }

    public function getId () {
        return $this->id;
    }

    public function setId ($id) {
        $this->id = $id;
    }

    public function getName () {
        return $this->name;
    }

    public function setName ($name) {
        $this->name = $name;
    }
    public function getPlayedTime () {
        return $this->playedTime;
    }

    public function setPlayedTime ($playedTime) {
        $this->playedTime = $playedTime;
    }
    public function getLinkSong () {
        return $this->linkSong;
    }

    public function setLinkSong ($linkSong) {
        $this->linkSong = $linkSong;
    }
    public function getLinkPicture () {
        return $this->linkPicture;
    }

    public function setLinkPicture ($linkPicture) {
        $this->linkPicture = $linkPicture;
    }
}
?>