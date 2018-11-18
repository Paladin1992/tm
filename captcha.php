<?php
	class captcha {
	/*
		1. Get current time in seconds since 01/01/1970
			$time = date('U')
		2. Randomly swap $time's characters and store it as $token
		3. Generate hash from the current datetime with md5()
			$hash = md5(date('YmdHis'));
		4. Replace the characters in the hash at position 2, 4, 8, 16 respectively with the token's mapped characters
			mapping:
				from: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, a, b, c, d, e, f]
				to:   [a, 4, c, 8, 1, e, b, f, 3, d, 0, 6, 2, 9, 5, 7]
			$hash[2] = map($token[0]);
			$hash[4] = map($token[1]);
			$hash[8] = map($token[2]);
			$hash[16] = map($token[3]);
			$sum = 3 + intval($token) % 7
		5. Generate captcha addition
		6. Return captcha and hash to client
		[POST request with the hash attached to it]
		7. Get the characters of the hash at position 2, 4, 8, 16 and concatenate them together into $token
		8. Convert the string value to a number, then calculate 3 + $value mod 7 (use intval())
			$token = map($hash[2]).map($hash[4]).map($hash[8]).map($hash[16])
			$sum = 3 + intval($token) % 7
		9. Compare $sum with $_POST['sum']
	*/

		private static $font = 'fonts/arial.ttf';
		public static $hash = null;
		private static $width = 50;
		private static $height = 50;
		private static $font_size = 30;
		private static $character_width = 15;

		public static function map($char) {
			$from = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f'];
			$to   = ['a', '4', 'c', '8', '1', 'e', 'b', 'f', '3', 'd', '0', '6', '2', '9', '5', '7'];

			for ($i = 0; $i < count($from); $i++) {
				if ($from[$i] == $char) {
					return $to[$i];
				}
			}

			return '';
		}
		
		private static function randomize_chars($str) {
			for ($i = 0; $i < strlen($str) / 2; $i++) {
				$fromIndex = rand(0, strlen($str) - 1);
				$toIndex = rand(0, strlen($str) - 1);
				
				if ($fromIndex == $toIndex) {
					$i--;
				} else {
					$temp = $str[$fromIndex];
					$str[$fromIndex] = $str[$toIndex];
					$str[$toIndex] = $temp;
				}
			}

			return $str;
		}

		public static function calculate_sum($token) {
			// returns a sum between 2 and 9
			return 2 + intval($token) % 8;
		}

		private static function generate_code() {
			// get seconds since 01/01/1970
			$now = date('U');

			// randomly swap characters
			$token = substr(self::randomize_chars($now), 0, 4);

			// generate an MD5 hash from the seconds elapsed since 01/01/1970
			$hash = md5(date('U'));

			// replace the characters of the hash at position 2, 4, 8, and 16
			$hash[2] = self::map($token[0]);
			$hash[4] = self::map($token[1]);
			$hash[8] = self::map($token[2]);
			$hash[16] = self::map($token[3]);

			// get a sum between 2 and 9
			$sum = self::calculate_sum($token);

			$operand1 = rand(1, $sum - 1);
			$operand2 = $sum - $operand1;

			$code = $operand1.' + '.$operand2.' =';
			self::$width = strlen($code) * self::$character_width;
			self::$hash = $hash;

			return $code;
		}
		
		private static function get_width() {
			return self::$width + 50;
		}
		
		private static function get_height() {
			return self::$height;
		}
		
		public static function image() {
			$code = self::generate_code();
			ob_start();

			// create an empty image
			$image = imagecreatetruecolor(self::get_width(), self::get_height());

			// allocate white color
			$white = imagecolorallocate($image, 255, 255, 255);

			// fill the whole image with white color
			imagefilledrectangle($image, 0, 0, self::get_width(), self::get_height(), $white);

			// random dots (short lines)
			for ($dot = 0; $dot < 100; $dot++) {
				$r = rand(150, 255);
				$g = rand(150, 255);
				$b = rand(150, 255);
				$dot_color = imagecolorallocate($image, $r, $g, $b);

				// spots
				$centerX = rand(0, self::get_width());
				$centerY = rand(0, self::get_height());
				$w = 25;
				$h = $w; // we want a circle
				imagefilledellipse($image, $centerX, $centerY, $w, $h, $dot_color);
			}

			// render text onto the image
			$offsetX = 22;
			for ($i = 0; $i < strlen($code); $i++) {
				$r = rand(0, 80);
				$g = rand(0, 80);
				$b = rand(0, 80);
				$color = imagecolorallocate($image, $r, $g, $b);
				$character = $code[$i];
				$x = self::$character_width * $i + $offsetX;
				$y = 40;
				imagettftext($image, self::$font_size, 0, $x, $y, $color, self::$font, $character);
			}

			imagepng($image);
			imagedestroy($image);
			$source = ob_get_contents();
			ob_end_clean();

			return "data:image/png;base64,".base64_encode($source);
		}
	}
?>