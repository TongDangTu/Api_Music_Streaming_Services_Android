<?php
class Artist {
    private string $id;
    private string $name;
    private string $linkPicture;

    public function __construct($id, $name, $linkPicture) {
        $this->id = $id;
        $this->name = $name;
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

    public function getLinkPicture () {
        return $this->linkPicture;
    }

    public function setLinkPicture ($linkPicture) {
        $this->linkPicture = $linkPicture;
    }
}
?>