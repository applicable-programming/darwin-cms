<?php

abstract class Entity {
    
    protected $dbc;
    protected $tableName;
    protected $fields;
    
    // Force Extending class to define this method
    abstract protected function initFields();
    
    protected function __construct($dbc, $tableName){
        $this->dbc = $dbc;
        $this->tableName = $tableName;
        $this->initFields();
    }
    
    
    public function findBy($fieldName, $fieldValue){
 

        $result = $this->find($fieldName, $fieldValue);
        if($result && $result[0]){
            $this->setValues($this, $result[0]);
        }
    }
    
    public function findAll() {
        $results = [];
        $databaseData =  $this->find();
        
        if($databaseData){
            $className = static::class;
            foreach ($databaseData as $objectData) {
                $object = new $className($this->dbc);
                $object = $this->setValues($object, $objectData);
                $results[] = $object;
            }
        }
        return $results;
    }
    
    private function find($fieldName = '', $fieldValue = '') {
        
        $results = [];
        $preparedFields = [];
        $sql = "SELECT * FROM " . $this->tableName;
        if($fieldName){
            $sql .= " WHERE " . $fieldName . " = :value";
            $preparedFields = ['value'=> $fieldValue];
        }
        $stmt = $this->dbc->prepare($sql);
        $stmt->execute($preparedFields);
        
        $databaseData = $stmt->fetchAll();
        // var_dump($databaseData);
        return $databaseData;
        
    }
    
    public function setValues($object, $values) {
        
        foreach ($object->fields as $fieldName) {
            $object->$fieldName = $values[$fieldName];
        }
        return $object;
    }
}