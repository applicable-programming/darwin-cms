<?php
namespace src;
abstract class Entity {
    
    protected $dbc;
    protected $tableName;
    protected $fields;
    protected $primaryKeys = ['id'];
    
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
            $this->setValues($result[0]);
        }
    }
    
    public function findAll() {
        $results = [];
        $databaseData =  $this->find();
        
        if($databaseData){
            $className = static::class;
            foreach ($databaseData as $objectData) {
                $object = new $className($this->dbc);
                $object = $this->setValues($objectData, $object);
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
    
    public function setValues($values, $object = null ) {
        if($object === null){
            $object = $this;
        }
        
        foreach ($object->primaryKeys as $keyName) {
            if(isset($values[$keyName])){
                $object->$keyName = $values[$keyName];
            }
        }
        
        foreach ($object->fields as $fieldName) {
            if(isset($values[$fieldName])){
                $object->$fieldName = $values[$fieldName];
            }
        }
        return $object;
    }
    
    public function save() {
        
        $fieldBindings = [];
        $keyBindings = [];
        $preparedFields = [];
        
        foreach ($this->primaryKeys as $keyName){
            $keyBindings[$keyName] = $keyName . ' = :' . $keyName;
            $preparedFields[$keyName] = $this->$keyName;
        }
        
        foreach ($this->fields as $fieldName){
            $fieldBindings[$fieldName] = $fieldName . ' = :' . $fieldName;
            $preparedFields[$fieldName] = $this->$fieldName;
        }
        
        $fieldBindingsString = join(', ', $fieldBindings);
        $keyBindingsString = join(', ', $keyBindings);
        $sql = "UPDATE " . $this->tableName . " SET " . $fieldBindingsString
                . " WHERE " . $keyBindingsString;

        $stmt = $this->dbc->prepare($sql);
        $stmt->execute($preparedFields);
        
    }
}





