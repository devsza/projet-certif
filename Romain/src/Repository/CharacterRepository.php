<?php

require_once dirname(__DIR__, 2) . "/lib/Repository/AbstractRepository.php";
require_once dirname(__DIR__) . "/Model/Sheet.php";

class CharacterRepository extends AbstractRepository
{

    /**
     * @param string $id article 
     * @return Article|null
     */
    public function find(int $id)
    {
        $query = "SELECT * FROM sheet WHERE id = :id;";
        $params = [":id" => $id];

        return  $this->executeQuery($query, "sheet", $params);
    }
    
    /**
     * @return array collection Article
     */
    public function findAll()
    {
        $query = "SELECT * FROM sheet;";
        return $this->executeQuery2($query, "Sheet");
    }

    /**
     * @param Article $article
     * @return void
     */
    public function add(Sheet $sheet)
    {
        $query = "INSERT INTO sheet(name, difficulty, description, file_path_image, gender, nationality, power, weapon) 
                  VALUES(:name, :difficulty, :description, :file_path_image, :gender, :nationality, :power, :weapon);";
        $params = [
            ":name"             => $sheet->getName(),
            ":difficulty"       => $sheet->getDifficulty(),
            ":description"      => $sheet->getDescription(),
            ":file_path_image"  => $sheet->getFile_path_image(),
            ":gender"           => $sheet->getGender(),
            ":nationality"      => $sheet->getNationality(),
            ":power"            => $sheet->getPower(),
            ":weapon"           => $sheet->getWeapon()
           
        ];

        return $this->executeQuery2($query, "Sheet", $params);
    }

    /**
     * @param string $id article 
     * @return Article|null
     */
    public function findLast()
    {
        $query = "SELECT * FROM sheet ORDER BY id DESC LIMIT 1;";
        return  $this->executeQuery2($query, "sheet")[0];
    }

    /**
     * @param Article $article
     */
    public function deleted(Sheet $sheet)
    {
        // supprime la ligne de l'article
        $query = "DELETE FROM sheet WHERE id = :id";
        $params = [
            ":id" => $sheet->getId()
        ];
        return $this->executeQuery($query, "Sheet", $params);
    }


    /**
     * @param Article $article
     * requete + params requete
     */
    public function update(Sheet $sheet)
    {
        $query = "  UPDATE sheet SET name = :name, nationality = :nationality, gender = :gender, description = :description, difficulty = :difficulty, power = :power, weapon = :weapon, file_path_image = :file_path_image
                    WHERE id = :id";
        $params = [
            ":name" => $sheet->getName(),
            ":nationality" => $sheet->getNationality(),
            ":gender" => $sheet->getGender(),
            ":description" => $sheet->getDescription(),
            ":difficulty" => $sheet->getDifficulty(),
            ":power" => $sheet->getPower(),
            ":weapon" => $sheet ->getWeapon(),
            ":file_path_image" => $sheet->getFile_path_image(),
            ":id" => $sheet->getid()
        ];
        return $this->executeQuery($query, "Sheet", $params);
    }
}
