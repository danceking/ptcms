<?php
class AuthorModel extends Model { public function getinfo($zym_10) { $zym_9 = $this->where(['user_id' => $zym_10])->find(); return $zym_9; } public function add($zym_5) { $this->set('user',$zym_5['user_id'],['author'=>1]); return true; } public function getid($zym_7) { $zym_10=$this->where(['name'=>$zym_7])->getfield('id'); if(!$zym_10){ $zym_6 = pinyin::change($zym_7); do { $zym_8 = $this->field('id')->where(array('pinyin' => $zym_6))->find(); if (!empty($zym_8)) { $zym_6 .= rand(0, 9); } } while (!empty($zym_8)); $zym_10=$this->insert(['name'=>$zym_7,'user_id'=>0,'pinyin'=>$zym_6]); } return $zym_10; } }
?>