<?php

namespace RegistroBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;



/**
 * Registro
 *
 * @ORM\Table(name="registro")
 * @ORM\Entity(repositoryClass="RegistroBundle\Repository\RegistroRepository")
 * @Vich\Uploadable
 * @UniqueEntity("mail")
 * @ORM\HasLifecycleCallbacks
 */
class Registro
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=100)
     * @Assert\NotBlank()
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="materno", type="string", length=100, nullable=true)
     *
     */
    private $materno;

    /**
     * @var string
     *
     * @ORM\Column(name="paterno", type="string", length=100)
     * @Assert\NotBlank()
     */
    private $paterno;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion", type="string", length=500)
     * @Assert\NotBlank()
     */
    private $direccion;

    /**
     * @var string
     *
     * @ORM\Column(name="mail", type="string", length=255, unique=true)
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email.",
     *     checkMX = true)
     */
    private $mail;


    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="registro_solicitud", fileNameProperty="solicitudName")
     *
     * @Assert\File(
     *     maxSize = "10M",
     * uploadFormSizeErrorMessage = "El archivo debe ser menor a 10 MB",
     *     mimeTypes = {"application/pdf", "application/x-pdf"},
     *     mimeTypesMessage = "Please upload a valid PDF"
     * )
     *
     * @var File
     */
    public $solicitudFile;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $solicitudName;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="registro_cv", fileNameProperty="cvName")
     *
     * @Assert\File(
     *     maxSize = "10M",
     * uploadFormSizeErrorMessage = "El archivo debe ser menor a 10 MB",
     *     mimeTypes = {"application/pdf", "application/x-pdf"},
     *     mimeTypesMessage = "Please upload a valid PDF"
     * )
     *
     * @var File
     */
    public $cvFile;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $cvName;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="registro_comprobante", fileNameProperty="comprobanteName")
     *
     * @Assert\File(
     *     maxSize = "10M",
     * uploadFormSizeErrorMessage = "El archivo debe ser menor a 10 MB",
     *     mimeTypes = {"application/pdf", "application/x-pdf"},
     *     mimeTypesMessage = "Please upload a valid PDF"
     * )
     *
     * @var File
     */
    public $comprobanteFile;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $comprobanteName;



    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="registro_proyecto", fileNameProperty="proyectoName")
     *
     * @Assert\File(
     *     maxSize = "10M",
     * uploadFormSizeErrorMessage = "El archivo debe ser menor a 10 MB",
     *     mimeTypes = {"application/pdf", "application/x-pdf"},
     *     mimeTypesMessage = "Please upload a valid PDF"
     * )
     *
     * @var File
     */
    public $proyectoFile;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $proyectoName;


    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="registro_articulos", fileNameProperty="articulosName")
     *
     * @Assert\File(
     *     maxSize = "30M",
     * uploadFormSizeErrorMessage = "El archivo de artículos debe ser menor a 25 MB",
     *     mimeTypes = {"application/pdf", "application/x-pdf"},
     *     mimeTypesMessage = "Please upload a valid PDF"
     * )
     *
     * @var File
     */
    public $articulosFile;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $articulosName;

    /**
     * @var string
     *
     * @ORM\Column(name="ref1nombre", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $ref1nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="ref1mail", type="string", length=255)
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email.",
     *     checkMX = true)
     */
    private $ref1mail;



    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="registro_ref1recom", fileNameProperty="ref1recomName")
     *
     * @Assert\File(
     *     maxSize = "2M",
     * uploadFormSizeErrorMessage = "El archivo debe ser menor a 2 MB",
     *     mimeTypes = {"application/pdf", "application/x-pdf"},
     *     mimeTypesMessage = "Please upload a valid PDF"
     * )
     *
     * @var File
     */
    public $ref1recomFile;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $ref1recomName;

    /**
     * @var string
     *
     * @ORM\Column(name="ref2nombre", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $ref2nombre;


    /**
     * @var string
     *
     * @ORM\Column(name="ref2mail", type="string", length=255)
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email.",
     *     checkMX = true)
     */
    private $ref2mail;


    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="registro_ref2recom", fileNameProperty="ref2recomName")
     *
     * @Assert\File(
     *     maxSize = "2M",
     * uploadFormSizeErrorMessage = "El archivo debe ser menor a 2 MB",
     *     mimeTypes = {"application/pdf", "application/x-pdf"},
     *     mimeTypesMessage = "Please upload a valid PDF"
     * )
     *
     * @var File
     */
    public $ref2recomFile;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $ref2recomName;


    /**
     * @var bool
     *
     * @ORM\Column(name="activo", type="boolean", nullable=true)
     */
    private $activo;

    /**
     * @var bool
     *
     * @ORM\Column(name="biomat", type="boolean", nullable=true)
     */
    private $biomat;


    /**
     * @ORM\Column(type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="datetime")
     *
     * @var \DateTime
     */
    private $createdAt;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Registro
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set materno
     *
     * @param string $materno
     * @return Registro
     */
    public function setMaterno($materno)
    {
        $this->materno = $materno;

        return $this;
    }

    /**
     * Get materno
     *
     * @return string 
     */
    public function getMaterno()
    {
        return $this->materno;
    }

    /**
     * Set paterno
     *
     * @param string $paterno
     * @return Registro
     */
    public function setPaterno($paterno)
    {
        $this->paterno = $paterno;

        return $this;
    }

    /**
     * Get paterno
     *
     * @return string 
     */
    public function getPaterno()
    {
        return $this->paterno;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     * @return Registro
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get direccion
     *
     * @return string 
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set mail
     *
     * @param string $mail
     * @return Registro
     */
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get mail
     *
     * @return string 
     */
    public function getMail()
    {
        return $this->mail;
    }


    /**
     * Set solicitudFile
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $solicitud
     */
    public function setSolicitudFile(File $solicitud = null)
    {
        $this->solicitudFile = $solicitud;
        if ($solicitud) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTime('now');
        }
    }

    /**
     * Get solicitudFile
     *
     * @return File
     */
    public function getSolicitudFile()
    {
        return $this->solicitudFile;
    }

    /**
     * @return mixed
     */
    public function getSolicitudName()
    {
        return $this->solicitudName;
    }

    /**
     * @param mixed $solicitudName
     */
    public function setSolicitudName($solicitudName)
    {
        $this->solicitudName = $solicitudName;
    }


    /**
     * Set cvFile
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $cv
     */
    public function setCartaFile(File $cv = null)
    {
        $this->cvFile = $cv;
        if ($cv) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTime('now');
        }
    }

    /**
     * Get cvFile
     *
     * @return File
     */
    public function getCvFile()
    {
        return $this->cvFile;
    }

    /**
     * @return mixed
     */
    public function getCvName()
    {
        return $this->cvName;
    }

    /**
     * @param mixed $cvName
     */
    public function setCvName($cvName)
    {
        $this->cvName = $cvName;
    }


    /**
     * Set comprobanteFile
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $comprobante
     */
    public function setComprobanteFile(File $comprobante = null)
    {
        $this->comprobanteFile = $comprobante;
        if ($comprobante) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTime('now');
        }
    }

    /**
     * Get comprobanteFile
     *
     * @return File
     */
    public function getComprobanteFile()
    {
        return $this->comprobanteFile;
    }

    /**
     * @return mixed
     */
    public function getComprobanteName()
    {
        return $this->comprobanteName;
    }

    /**
     * @param mixed $comprobanteName
     */
    public function setComprobanteName($comprobanteName)
    {
        $this->comprobanteName = $comprobanteName;
    }

    /**
     * Set proyectoFile
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $proyecto
     */
    public function setProyectoFile(File $proyecto = null)
    {
        $this->proyectoFile = $proyecto;
        if ($proyecto) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTime('now');
        }
    }

    /**
     * Get proyectoFile
     *
     * @return File
     */
    public function getProyectoFile()
    {
        return $this->proyectoFile;
    }

    /**
     * @return mixed
     */
    public function getProyectoName()
    {
        return $this->proyectoName;
    }

    /**
     * @param mixed $proyectoName
     */
    public function setProyectoName($proyectoName)
    {
        $this->proyectoName = $proyectoName;
    }


    /**
     * Set articulosFile
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $articulos
     */
    public function setArticulosFile(File $articulos = null)
    {
        $this->articulosFile = $articulos;
        if ($articulos) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTime('now');
        }
    }

    /**
     * Get articulosFile
     *
     * @return File
     */
    public function getArticulosFile()
    {
        return $this->articulosFile;
    }

    /**
     * @return mixed
     */
    public function getArticulosName()
    {
        return $this->articulosName;
    }

    /**
     * @param mixed $articulosName
     */
    public function setArticulosName($articulosName)
    {
        $this->articulosName = $articulosName;
    }

    /**
     * Set ref1nombre
     *
     * @param string $ref1nombre
     * @return Registro
     */
    public function setRef1nombre($ref1nombre)
    {
        $this->ref1nombre = $ref1nombre;

        return $this;
    }

    /**
     * Get ref1nombre
     *
     * @return string 
     */
    public function getRef1nombre()
    {
        return $this->ref1nombre;
    }

    /**
     * Set ref1mail
     *
     * @param string $ref1mail
     * @return Registro
     */
    public function setRef1mail($ref1mail)
    {
        $this->ref1mail = $ref1mail;

        return $this;
    }

    /**
     * Get ref1mail
     *
     * @return string 
     */
    public function getRef1mail()
    {
        return $this->ref1mail;
    }


    /**
     * Set ref1recomFile
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $ref1recom
     */
    public function setRef1recomFile(File $ref1recom = null)
    {
        $this->ref1recomFile = $ref1recom;
        if ($ref1recom) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTime('now');
        }
    }

    /**
     * Get ref1recomFile
     *
     * @return File
     */
    public function getRef1recomFile()
    {
        return $this->ref1recomFile;
    }

    /**
     * @return mixed
     */
    public function getRef1recomName()
    {
        return $this->ref1recomName;
    }

    /**
     * @param mixed $ref1recomName
     */
    public function setRef1recomName($ref1recomName)
    {
        $this->ref1recomName = $ref1recomName;
    }


    /**
     * Set ref2nombre
     *
     * @param string $ref2nombre
     * @return Registro
     */
    public function setRef2nombre($ref2nombre)
    {
        $this->ref2nombre = $ref2nombre;

        return $this;
    }

    /**
     * Get ref2nombre
     *
     * @return string 
     */
    public function getRef2nombre()
    {
        return $this->ref2nombre;
    }

    /**
     * Set ref2mail
     *
     * @param string $ref2mail
     * @return Registro
     */
    public function setRef2mail($ref2mail)
    {
        $this->ref2mail = $ref2mail;

        return $this;
    }

    /**
     * Get ref2mail
     *
     * @return string 
     */
    public function getRef2mail()
    {
        return $this->ref2mail;
    }

    /**
     * Set recom2File
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $recom2
     */
    public function setRef2recomFile(File $ref2recom = null)
    {
        $this->ref2recomFile = $ref2recom;
        if ($ref2recom) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTime('now');
        }
    }

    /**
     * Get ref2recom2File
     *
     * @return File
     */
    public function getRef2recomFile()
    {
        return $this->ref2recomFile;
    }

    /**
     * @return mixed
     */
    public function getRef2recomName()
    {
        return $this->ref2recomName;
    }

    /**
     * @param mixed $ref2recomName
     */
    public function setRef2recomName($ref2recomName)
    {
        $this->ref2recomName = $ref2recomName;
    }

    /**
     * Set activo
     *
     * @param boolean $activo
     * @return Registro
     */
    public function setActivo($activo)
    {
        $this->activo = $activo;

        return $this;
    }

    /**
     * Get biomat
     *
     * @return boolean 
     */
    public function getBiomat()
    {
        return $this->biomat;
    }

    /**
     * Set Biomat
     *
     * @param boolean $biomat
     * @return Registro
     */
    public function setBiomat($biomat)
    {
        $this->biomat = $biomat;

        return $this;
    }

    /**
     * Get activo
     *
     * @return boolean
     */
    public function getActivo()
    {
        return $this->activo;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Registro
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Registro
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

}
