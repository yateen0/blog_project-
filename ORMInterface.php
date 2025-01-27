<?php
// ORMInterface.php
// Interface met methodes die elk model moet implementeren.

interface ORMInterface {
    public function save();        // Opslaan van een record
    public function delete();      // Verwijderen van een record
    public function getID();       // ID ophalen
    public static function findByID($id); // Record vinden op ID
    public static function findAll();     // Alle records ophalen
}