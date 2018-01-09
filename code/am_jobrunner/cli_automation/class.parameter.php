<?php

class Parameter {
  private $_type;
  private $_name;
  private $_value;


  public function __contruct($type, $name, $value) {
    $this->_type = $type;
    $this->_name = $name;
    $this->_value = $value;
  }
  public function setValue($value) {
    $this->_value = $value;
  }
  public function __tostring() {
    json_encode($this);
  }
  public function getValue() {
    return $this->_value;
  }
  public function getName() {
    return $this->_name;
  }
  public function getParameterType() {
    return $this->_type;
  }
}
