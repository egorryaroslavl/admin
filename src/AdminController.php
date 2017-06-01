<?php


	namespace Egorryaroslavl\Admin;

	use App\Http\Controllers\Controller;

	class AdminController extends Controller
	{


		public function index()
		{
			return view( 'admin::index' );

		}

		public function translite( Request $request ){

			$dictionary = array(
				"А" => "a",
				"Б" => "b",
				"В" => "v",
				"Г" => "g",
				"Д" => "d",
				"Е" => "e",
				"Ж" => "zh",
				"З" => "z",
				"И" => "i",
				"Й" => "y",
				"К" => "K",
				"Л" => "l",
				"М" => "m",
				"Н" => "n",
				"О" => "o",
				"П" => "p",
				"Р" => "r",
				"С" => "s",
				"Т" => "t",
				"У" => "u",
				"Ф" => "f",
				"Х" => "h",
				"Ц" => "ts",
				"Ч" => "ch",
				"Ш" => "sh",
				"Щ" => "sch",
				"Ъ" => "",
				"Ы" => "yi",
				"Ь" => "",
				"Э" => "e",
				"Ю" => "yu",
				"Я" => "ya",
				"а" => "a",
				"б" => "b",
				"в" => "v",
				"г" => "g",
				"д" => "d",
				"е" => "e",
				"ж" => "zh",
				"з" => "z",
				"и" => "i",
				"й" => "y",
				"к" => "k",
				"л" => "l",
				"м" => "m",
				"н" => "n",
				"о" => "o",
				"п" => "p",
				"р" => "r",
				"с" => "s",
				"т" => "t",
				"у" => "u",
				"ф" => "f",
				"х" => "h",
				"ц" => "ts",
				"ч" => "ch",
				"ш" => "sh",
				"щ" => "sch",
				"ъ" => "y",
				"ы" => "y",
				"ь" => "",
				"э" => "e",
				"ю" => "yu",
				"я" => "ya",
				"-" => "_",
				" " => "_",
				"," => "_",
				"." => "_",
				"?" => "",
				"!" => "",
				"«" => "",
				"»" => "",
				":" => "",
				'ё' => "e",
				'Ё' => "e",
				"*" => "",
				"(" => "",
				")" => "",
				"[" => "",
				"]" => "",
				"<" => "",
				">" => ""
			);
			$string     = preg_replace( '/[^\w\s]/u', ' ', $string );
			$string     = mb_strtolower( strtr( strip_tags( trim( $string ) ), $dictionary ) );
			return preg_replace( '/[_]+/', '_', $string );
		}


 		public static function mainMenu()
		{

			$path = config_path( 'admin' );
			$menu = [];
			$mainLink = config('admin.menu');
			$menu[] = $mainLink[0];
			/* обходим директорию $path в поисках файлов конфигураций */
			foreach( glob( $path . "/*.php" ) as $filename ){
				$basename = basename( $filename );
				$fileName = str_replace( ".php", "", $basename );

				/* если в файле есть массив с ключом "menu" забираем его в массив $menu[]  */
				if( !is_null( config( 'admin.' . $fileName . '.menu' ) ) ){
					$menu[] = config( 'admin.' . $fileName . '.menu' );
				}

			}
			return $menu;
		}

	public static function iconsave( Request $request )
		{
			if( $request->hasFile( 'photo' ) ){
				
				$uploads_dir = sys_get_temp_dir();
				$file     = $request->file( 'photo' );
				$ext      = $file->clientExtension();
				$tmp_name = $_FILES[ "photo" ][ "tmp_name" ];
				/*$name     = basename( $_FILES[ "photo" ][ "name" ] );*/
				$name = 'icon_' . $_POST[ 'table' ] . "_" . $_POST[ 'id' ] . ".$ext";
				$res = move_uploaded_file( $tmp_name, "$uploads_dir/$name" );
				if( $res > 0 ){
					echo json_encode( [ 'error' => 'ok', 'message' => $uploads_dir . '/' . $name ] );
				}
			}
		}

	}