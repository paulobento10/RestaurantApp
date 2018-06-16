<?php

	/**
	* Este é a classe genérica que define uma pessoa
	*/
	class Person
	{
		private $nome;
		private $data_nascimento;
		private $email;
		private $num_telefone;
		private $morada;

		function __construct($nome,$data_nascimento,$email,$num_telefone,$morada)
		{
			$this->nome=$nome;
			$this->data_nascimento=$data_nascimento;
			$this->email=$email;
			$this->num_telefone=$num_telefone;
			$this->morada=$morada;
		}

		public function getNome(){
			return $this->nome;
		}
		public function setNome($nome){
			$this->nome=$nome;
		}

		public function getDataNascimeto(){
			return $this->data_nascimento;
		}
		public function setDataNascimento($data_nascimento){
			$this->data_nascimento=$data_nascimento;
		}

		public function getEmail(){
			return $this->email;
		}
		public function setEmail($email){
			$this->email=$email;
		}

		public function getMorada(){
			return $this->morada;
		}
		public  function setMorada($morada){
			$this->morada=$morada;
		}
	}


	/**
	* 
	*/
	class Dono extends Person
	{
		
		private $id_dono;
		private $username_dono;
		private $password_dono;

		function __construct($nome,$data_nascimento,$email,$num_telefone,$morada, $id_dono,$username_dono,$password_dono)
		{
			$this->id_dono=$id_dono;
			$this->username_dono=$username_dono;
			$this->password_dono=$password_dono;
			parent::__construct($nome,$data_nascimento,$email,$num_telefone,$morada);
		}

		public function loginDono(){

		}

		public function registerDono(){

		}

		public function adicionarEstabelecimento(){

		}

		public function editarEstabelecimento(){

		}

		public function apagarEstabelecimento(){

		}

		public function getId_dono(){
			return $this->id_dono;
		}
		public function setId_dono($id_dono){
			$this->id_dono=$id_dono;
		}

		public function getUsername_dono(){
			return $this->userName;
		}
		public function setUsername_dono($username_dono){
			$this->username_dono=$username_dono;
		}

		public function getPassword_dono(){
			return $this->userName;
		}
		public function setPassword_dono($password_dono){
			$this->password_dono=$password_dono;
		}
	}

	/**
	* Esta é a classe User que extende de Pessoa
	*/
	class User extends Person
	{
		
		private $id;
		private $userName;
		private $password;

		function __construct($nome,$data_nascimento,$email,$num_telefone,$morada, $id,$userName,$password)
		{
			$this->id=$id;
			$this->userName=$userName;
			$this->password=$password;
			parent::__construct($nome,$data_nascimento,$email,$num_telefone,$morada);
		}


		public function loginUser(){

		}

		public function registerUser(){

		}

		public function pedirNewsletter(){

		}

		public function pesquisarRestaurantesPreco(){

		}

		public function pesquisarRestaurantesLocalizacao(){
			
		}

		public function pesquisarRestaurantesComida(){
			
		}

		public function pesquisarRestaurantesServico(){
			
		}

		public function reservaDireta(){
			
		}

		public function marcarReserva(){
			
		}

		public function editarReserva(){
			
		}

		public function cancelarReserva(){
			
		}

		public function getId(){
			return $this->id;
		}
		public  function setId($id){
			$this->id=$id;
		}

		public function getUserName(){
			return $this->userName;
		}
		public  function setUserName($userName){
			$this->userName=$userName;
		}

		public function getPassword(){
			return $this->password;
		}
		public  function setPassword($password){
			$this->password=$password;
		}
	}


	/**
	*  Esta é a classe do utilizador administrdor que possúi todas as propeidades do utilizador genérico e mais algumas
	*/
	class AdminUser extends User
	{
		private $id_admin;
		private $nivel_privilegio;

		function __construct($id,$userName,$password, $id_admin,$nivel_privilegio)
		{
			$this->id_admin=$id_admin;
			$this->nivel_privilegio=$nivel_privilegio;
			parent::__construct($id,$userName,$password);
		}

		public function getId_Admin(){
			return $this->id_admin;
		}
		public  function setId_Admin($id_admin){
			$this->id_admin=$id_admin;
		}

		public function getNivelPrivilegio(){
			return $this->nivel_privilegio;
		}
		public  function setNivelPrivilegio($nivel_privilegio){
			$this->nivel_privilegio=$nivel_privilegio;
		}
	}

	?>