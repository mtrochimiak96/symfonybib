<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticleRepository")
 */
class Article
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
	
	/**
	   * @ORM\Column(type="text", length=255)
	   */
	private $title;
	
	/**
	   * @ORM\Column(type="text")
	   */
	private $doi;
	
	/**
	   * @ORM\Column(type="integer", length=11)
	   */
	private $minipoint;
	
	/**
	   * @ORM\Column(type="text", length=80)
	   */
	private $conftype;
	
	/**
	   * @ORM\Column(type="text")
	   */
	private $confvalue;
	
	/**
	   * @ORM\Column(type="date")
	   */
	private $publicdate;
	
	/**
	   * @ORM\Column(type="text")
	   */
	private $shares;
	
	/**
	   * @ORM\Column(type="text")
	   */
	private $author;
	   
    public function getId()
    {
        return $this->id;
    }
	
	public function getTitle()
    {
        return $this->title;
    }
	
		public function setTitle($title)
    {
        return $this->title = $title;
    }
	
		public function getDoi()
    {
        return $this->doi;
    }
	
		public function setDoi($doi)
    {
        return $this->doi = $doi;
    }
	
		public function getMinipoint()
    {
        return $this->minipoint;
    }
	
		public function setMinipoint($minipoint)
    {
        return $this->minipoint = $minipoint;
    }
	
		public function getConftype()
    {
        return $this->conftype;
    }
	
		public function setConftype($conftype)
    {
        return $this->conftype = $conftype;
    }
	
			public function getConfvalue()
    {
        return $this->confvalue;
    }
	
		public function setConfvalue($confvalue)
    {
        return $this->confvalue = $confvalue;
    }
	
			public function getPublicdate()
    {
        return $this->publicdate;
    }
	
		public function setPublicdate($publicdate)
    {
        return $this->publicdate = $publicdate;
    }
	
			public function getShares()
    {
        return $this->shares;
    }
	
		public function setShares($shares)
    {
        return $this->shares = $shares;
    }
	
			public function getAuthor()
    {
        return $this->author;
    }
	
		public function setAuthor($author)
    {
        return $this->author = $author;
    }
	
	
}
