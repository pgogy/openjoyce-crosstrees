<html>
	<head>
		<style>
		
			html{
				font-family:georgia;
			}
		
			.main{
				float:left;
				width:100%;
				clear:both;
			}
			
			.main .words{
				float:left;
				width:75%;
				position:relative;
			}
			
			.main .words div{
				float:left;
				position:relative;
				width:45%
			}
			
			.main .words div.left{
				border-right:50%;
			}
			
			.main .reason{
				float:left;
				width:25%;
				position:relative;
			}
			
			.same{ background:#fafafa; }
			.case{ background:#bbb; }
			.punc{ background:#f88; }
			.puncleft{ background:#f99; }
			.extrasright{ background:#faa; }
			.puncright{ background:#fbb; }
			.puncleft{ background:#fcc; }
			.puncleftstart{ background:#fee; }
			.puncrightstart{ background:fdd; }
			.letter{ background:#aaf; }
			.hyphen{ background:#bbf; }
			.apos{ background:#ccf; }
			.letteru{ background:#ccf; }
			.differentwords{ background:#9f9; }
			.extrawords{ background:#afa; }
			.extraleftwords{ background:#cfc; }
			.extrarightwords{ background:#efe; }
		
		</style>
	</head>
	<body>
		<div style="float:left; position:relative"><?PHP
		
			$store = array();
			$secondstore = array();
			
			//REPLACE twm.txt with the text file you want to open
			
			$textone = file_get_contents("twm.txt");
			
			$text = str_replace(array("-\r", "\n"),"",$textone);

			$newtext = str_replace(array("\r","\n"), " ", $text);

			$allwords = explode(" ", $newtext);
			
			foreach($allwords as $word){
			
				if(trim($word)!=""){
				
					array_push($store, $word);
				
				}
			
			}
			
			//REPLACE shakespeare.txt with the text file you want to open
			
			$texttwo = file_get_contents("shakespeare.txt");
			
			$words = str_replace(array("-\r", "\n"),"",$texttwo);

			$newwords = str_replace(array("\r","\n"), " ", $words);
			$allwords = str_replace(" :", ":", $newwords);
			
			$words = explode(" ", $allwords);
			
			foreach($words as $word){
			
				if(trim($word)!=""){
				
					array_push($secondstore, $word);
				
				}
			
			}
			
			$y=0;
			
			for($x=0;$x<=count($store);$x++){
			
				if(!isset($store[$x])||!isset($secondstore[$y])){
				
					break;
				
				}
			
				echo "<div class='main'>";
			
				if($store[$x]==$secondstore[$y]){
				
					echo "<div class='words'><div class='left'>" . $store[$x] . "</div><div>" . $secondstore[$y] . "</div></div><div class='reason same'>Same words</div>";
					$y++;
					
				}else if(strtolower($store[$x]) == strtolower($secondstore[$y])){
				
					echo "<div class='words'><div class='left'>" . $store[$x] . "</div><div>" . $secondstore[$y] . "</div></div><div class='reason case'>Case Change</div>";
					$y++;
		
				}else if(substr($store[$x],0,strlen($store[$x])-1) == substr($secondstore[$y],0,strlen($secondstore[$y])-1)){
				
					echo "<div class='words'><div class='left'>" . $store[$x] . "</div><div>" . $secondstore[$y] . "</div></div><div class='reason punc'>Different Punctuation</div>";
					$y++;
		
				}else if((substr($store[$x],0,strlen($store[$x])-1) == $secondstore[$y])&&(substr($store[$x],strlen($store[$x])-1,1)=="s")){
				
					echo "<div class='words'><div class='left'>" . $store[$x] . "</div><div>" . $secondstore[$y] . "</div></div><div class='reason puncleft'>Extra S (LHS)</div>";
					$y++;
		
				}else if(($store[$x] == substr($secondstore[$y],0,strlen($secondstore[$y])-1))&&(substr($secondstore[$y],strlen($secondstore[$y])-1,1)=="s")){
				
					echo "<div class='words'><div class='left'>" . $store[$x] . "</div><div>" . $secondstore[$y] . "</div></div><div class='reason extrasright'>Extra S (RHS)</div>";
					$y++;
		
				}else if($store[$x] == substr($secondstore[$y],0,strlen($secondstore[$y])-1)){
				
					echo "<div class='words'><div class='left'>" . $store[$x] . "</div><div>" . $secondstore[$y] . "</div></div><div class='reason puncright'>Extra Punctuation (RHS)</div>";
					$y++;
		
				}else if(substr($store[$x],0,strlen($store[$x])-1) == $secondstore[$y]){
				
					echo "<div class='words'><div class='left'>" . $store[$x] . "</div><div>" . $secondstore[$y] . "</div></div><div class='reason puncleft'>Extra Punctuation (LHS)</div>";
					$y++;
		
				}else if((substr($store[$x],0,1)=="-")&&(strtolower(substr($store[$x],1,strlen($store[$x])-1)) == strtolower($secondstore[$y]))){
				
					echo "<div class='words'><div class='left'>" . $store[$x] . "</div><div>" . $secondstore[$y] . "</div></div><div class='reason puncleftstart'>Extra Preceeding Punctuation (LHS)</div>";
					$y++;
					
				}else if((strtolower($store[$x]) == strtolower(substr($secondstore[$y],1,strlen($secondstore[$y])-1)))&&(substr($secondstore[$y],0,1)=="-")){
				
					echo "<div class='words'><div class='left'>" . $store[$x] . "</div><div>" . $secondstore[$y] . "</div></div><div class='reason puncrightstart'>Extra Preceeding Punctuation (RHS)</div>";
					$y++;
		
				}else if((strlen($store[$x])==strlen($secondstore[$y]))&&(substr($store[$x],0,1)==substr($secondstore[$y],0,1))){
				
					echo "<div class='words'><div class='left'>" . $store[$x] . "</div><div>" . $secondstore[$y] . "</div></div><div class='reason letter'>Possible Single Letter difference</div>";
					$y++;
				
				}else if((str_replace("-","",$store[$x])==$secondstore[$y])||($store[$x]==str_replace("-","",$secondstore[$y]))){
				
					echo "<div class='words'><div class='left'>" . $store[$x] . "</div><div>" . $secondstore[$y] . "</div></div><div class='reason hyphen'>Additional Hyphenation</div>";
					$y++;
				
				}else if((str_replace("'","",$store[$x])==$secondstore[$y])||($store[$x]==str_replace("'","",$secondstore[$y]))){
				
					echo "<div class='words'><div class='left'>" . $store[$x] . "</div><div>" . $secondstore[$y] . "</div></div><div class='reason apos'>Additional Apostrophe</div>";
					$y++;
				
				}else if((str_replace("u","",$store[$x])==$secondstore[$y])||($store[$x]==str_replace("u","",$secondstore[$y]))){
				
					echo "<div class='words'><div class='left'>" . $store[$x] . "</div><div>" . $secondstore[$y] . "</div></div><div class='reason letteru'>American Spelling</div>";
					$y++;
				
				}else if((str_replace("ur","r",$store[$x])==$secondstore[$y])||($store[$x]==str_replace("ur","r",$secondstore[$y]))){
				
					echo "<div class='words'><div class='left'>" . $store[$x] . "</div><div>" . $secondstore[$y] . "</div></div><div class='reason letteru'>American Spelling</div>";
					$y++;
				
				}else if($store[$x+1]==$secondstore[$y+1]){
				
					echo "<div class='words'><div class='left'>--" . $store[$x] . "--</div><div>--" . $secondstore[$y] . "--</div></div><div class='reason differentwords'>Single Different Word</div>";
					$y++;
					
				}else{
		
					$counter = 1;
					
					$orig_x = $x;
					$orig_y = $y;
					
					$match = false;
					
					while($match == false){
					
						if($store[$orig_x+$counter]==$secondstore[$orig_y+1]){
						
							$match = true;
							
							$left_missed = array_slice($store,$orig_x,$counter);
							
							echo "<div class='words'><div class='left'>" . implode(" ", $left_missed) . "</div><div>" . $secondstore[$y] . "</div></div><div class='reason extraleftwords'>Extra Words (LHS)</div>";
							
							$x = $orig_x + ($counter-1);
							$y = $orig_y+1;
						
						}
						
						if($store[$orig_x+1]==$secondstore[$orig_y+$counter]){
						
							$right_words = array_slice($secondstore,$orig_y,$counter);
							
							echo "<div class='words'><div class='left'>" . $store[$x] . "</div><div>" . implode(" ", $right_words) . "</div></div><div class='reason extrarightwords'>Extra Words (RHS)</div>";
							
							$match = true;
							$x = $orig_x+1;
							$y = $orig_y + ($counter+1);
						
						}
						
						if($counter==80){
						
							$temp = array_slice($store,$orig_x+1,20);
							$temp2 = array_slice($secondstore,$orig_y+1,20);
							
							$data = array_intersect($temp,$temp2);
							
							$match = true;
							
						}
						
						$counter++;
					
					}
					
				}
				
				echo "</div>";
				
			}
		
		?></div>
	</body>
</html>
<?PHP