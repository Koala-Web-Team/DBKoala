<?php

namespace App\Entity;

use App\Repository\CoursesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CoursesRepository::class)
 */
class Courses
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity=news::class, mappedBy="course")
     */
    private $news_id;

    public function __construct()
    {
        $this->news_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|news[]
     */
    public function getNewsId(): Collection
    {
        return $this->news_id;
    }

    public function addNewsId(news $newsId): self
    {
        if (!$this->news_id->contains($newsId)) {
            $this->news_id[] = $newsId;
            $newsId->setCourse($this);
        }

        return $this;
    }

    public function removeNewsId(news $newsId): self
    {
        if ($this->news_id->removeElement($newsId)) {
            // set the owning side to null (unless already changed)
            if ($newsId->getCourse() === $this) {
                $newsId->setCourse(null);
            }
        }

        return $this;
    }
}
