<?php

namespace EPS\JqGridBundle\Grid;


/**
 * Description of Column
 *
 * @author pascal
 */
class Column
{

  private $name;
  private $colmodel;

  public function __construct($name = null)
  {
    if ($name != null) {
      $this->name = $name;
    }
  }


  public function getName()
  {
    return $this->name;
  }


  public function setName($name)
  {
    $this->name = $name;
  }


  public function setColModel(array $colmodel)
  {
    $this->colmodel = $colmodel;
  }


  public function getColModel()
  {
    return $this->colmodel;
  }


  public function getFieldName()
  {
    return $this->colmodel['name'];
  }


  public function getFieldValue()
  {
    if (array_key_exists('value', $this->colmodel)) {
      return $this->colmodel['value'];
    }
    else {
      return false;
    }
  }


  public function getFieldIndex()
  {
    if (array_key_exists('index', $this->colmodel)) {
      return $this->colmodel['index'];
    }
    else {
      return false;
    }
  }


  public function getFieldTwig()
  {
    if (array_key_exists('twig', $this->colmodel)) {
      return $this->colmodel['twig'];
    }
    else {
      return false;
    }
  }


  public function getFieldHaving()
  {
    if (array_key_exists('having', $this->colmodel)) {
      return $this->colmodel['having'];
    }
    else {
      return false;
    }
  }


  public function getFieldFormatter()
  {
    if (array_key_exists('formatter', $this->colmodel)) {
      return $this->colmodel['formatter'];
    }
    else {
      return false;
    }
  }


  public function getColModelJson($prefix = '')
  {
    $model = $this->colmodel;
    $dp    = '';
    $sopt  = '';

    if (array_key_exists('sopt', $model) && $model['sopt']) {
      $sopt = '"sopt": ' . json_encode($model['sopt']) . ', ';
    }

    if (array_key_exists('datepicker', $model) && $model['datepicker']) {
      $dp = ' ,"searchoptions" : {dataInit : datePick, ' . $sopt . ' "attr" : { "title": "Choisir une date" }}';
    }

    unset($model['twig']);
    unset($model['having']);
    unset($model['value']);
    unset($model['datepicker']);

    //prefix index
    if (array_key_exists('name', $model)) {
      $model['name'] = $prefix . $model['name'];
    }

    $jsFunctions = '';
    if (array_key_exists('jsFunctions', $model) && $model['jsFunctions']) {
      $jsFunctions = $model['jsFunctions'];
      unset($model['jsFunctions']);
    }

    $models = json_encode($model);

    if (isset($jsFunctions) && is_array($jsFunctions)) {
      foreach ($jsFunctions as $func) {
        $models = str_replace('"' . $func . '"', $func, $models);
      }
    }

    $models = substr($models, 0, strlen($models) - 1) . $dp . '}';

    return $models;
  }


}
