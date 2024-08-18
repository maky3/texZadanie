<?php

namespace App\Entity\Car;

use App\Entity\Brand\Brand;
use App\Entity\Model\Model;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CarRepository\CarRepository;

#[ORM\Entity(repositoryClass: CarRepository::class)]
#[ORM\Table(name: '`car`')]
class Car
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private int $id;

    #[ORM\ManyToOne(targetEntity: Brand::class)]
    #[ORM\JoinColumn(name: "brand_id", referencedColumnName: "id")]
    private Brand $brand;

    #[ORM\ManyToOne(targetEntity: Model::class)]
    #[ORM\JoinColumn(name: "model_id", referencedColumnName: "id")]
    private Model $model;
    #[ORM\Column(type: "string", length: 255)]
    private string $photoPath;

    #[ORM\Column(type: "integer")]
    private int $price;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return Brand
     */
    public function getBrand(): Brand
    {
        return $this->brand;
    }

    /**
     * @param Brand $brand
     * @return Car
     */
    public function setBrand(Brand $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * @return Model
     */
    public function getModel(): Model
    {
        return $this->model;
    }

    /**
     * @param Model $model
     * @return $this
     */
    public function setModel(Model $model): self
    {
        $this->model = $model;
        return $this;
    }

    /**
     * @return string
     */
    public function getPhotoPath(): string
    {
        return $this->photoPath;
    }

    /**
     * @param string $photoPath
     * @return $this
     */
    public function setPhotoPath(string $photoPath): self
    {
        $this->photoPath = $photoPath;
        return $this;
    }

    /**
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
    }

    /**
     * @param int $price
     * @return $this
     */
    public function setPrice(int $price): self
    {
        $this->price = $price;
        return $this;
    }
}