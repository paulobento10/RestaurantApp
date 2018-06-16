<?php 

	/**
	* 
	*/
	class Estabelecimento
	{

		private $id;
		private $localizacao;
		private $morada;
		private $tipo;
		
		function __construct($id,$localizacao,$morada,$tipo)
		{
			$this->id=$id;
			$this->localizacao=$localizacao;
			$this->morada=$morada;
			$this->tipo=$tipo;
		}

		public function getId(){
			return $this->$id;
		}
		public  function setId($id){
			$this->id=$id;
		}


		public function getLocalizacao(){
			return $this->localizacao;
		}
		public  function setLocalizacao($localizacao){
			$this->localizacao=$localizacao;
		}

		public function getMorada(){
			return $this->morada;
		}
		public  function setMorada($morada){
			$this->morada=$morada;
		}

		public function getTipo(){
			return $this->tipo;
		}
		public  function setTipo($tipo){
			$this->tipo=$tipo;
		}
	}

	/**
	* 
	*/
	class Restaurante extends Estabelecimento
	{
		
		private $nome;
		private $telefone;
		private $email;

		function __construct($id,$localizacao,$morada,$tipo, $nome,$telefone,$email)
		{
			$this->nome=$nome;
			$this->telefone=$telefone;
			$this->email=$email;
			parent::__construct($id,$localizacao,$morada,$tipo);
		}

		public function login(){

		}

		public function registar(){
			
		}

		public function defineEmenta(){
			
		}

		public function editaEmenta(){
			
		}

		public function eliminaEmenta(){
			
		}

		public function defineHorario(){
			
		}

		public function editaHorario(){
			
		}

		public function eliminaHorario(){
			
		}

		public function definePrecos(){
			
		}

		public function alteraPrecos(){
			
		}

		public function eliminaPrecos(){
			
		}

		public function defineServicosPagamento(){
			
		}

		public function editaServicosPagamento(){
			
		}

		public function eliminaServicosPagamento(){
			
		}

		public function defineDescricao(){
			
		}

		public function alteraDescricao(){
			
		}

		public function eliminaDescricao(){
			
		}

		public function getNome(){
			return $this->nome;
		}
		public function setNome($nome){
			$this->nome=$nome;
		}

		public function getTelefone(){
			return $this->telefone;
		}
		public function setTelefone($telefone){
			$this->telefone=$telefone;
		}

		public function getEmail(){
			return $this->email;
		}
		public function setEmail($email){
			$this->email=$email;
		}
	}

	/**
	* 
	*/
	class Admin_Restaurante extends Restaurante
	{

		private $id_admin_restaurante;
		private $nivel_privilegio;
		
		function __construct($nome,$telefone,$email, $id_admin_restaurante,$nivel_privilegio)
		{
			$this->id_admin_restaurante=$id_admin_restaurante;
			$this->nivel_privilegio=$nivel_privilegio;
			parent::__construct($nome,$telefone,$email);
		}

		public function adicionarRestaurante(){

		}

		public function editarRestaurante(){
			
		}

		public function eliminarRestaurante(){
			
		}

		public function getId_admin_restaurante(){
			return $this->id_admin_restaurante;
		}
		public function setId_admin_restaurante($id_admin_restaurante){
			$this->id_admin_restaurante=$id_admin_restaurante;
		}


		public function getNivel_privilegio(){
			return $this->nivel_privilegio;
		}
		public function setNivel_privilegio($nivel_privilegio){
			$this->nivel_privilegio=$nivel_privilegio;
		}
	}

	?>