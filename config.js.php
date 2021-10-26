<?php
// Parse environment variables to JavaScript configuration file
// return JSONP config variable
header("content-type: application/javascript");

function startsWith ($string, $startString) {
    $len = strlen($startString);
    return (substr($string, 0, $len) === $startString);
}

$MAXQUIZ=30;
$MAXCONTENT=10;

$config= (object)[];
$config->title = getenv('APP_TITLE');
$config->quizzes = array();

for ($i = 0; $i <= $MAXQUIZ; $i++) {
  if(getenv("Q{$i}_ID")!==false){
    $quiz = (object)[];
    $quiz->id = getenv("Q{$i}_ID");
    $quiz->type = getenv("Q{$i}_TYPE");
    $quiz->title = getenv("Q{$i}_TITLE");
    if(getenv("Q{$i}_CHOICES")!==false){
      $quiz->choices = array_map('trim', explode(",", getenv("Q{$i}_CHOICES")));
    }
    $quiz->score = getenv("Q{$i}_SCORE");
    $quiz->icon = getenv("Q{$i}_ICON");
    $position = array_map('trim', explode(",", getenv("Q{$i}_POSITION")));
    $quiz->x = $position[0];
    $quiz->y = $position[1];
    
    $quiz->contents = array();
    for ($j = 0; $j <= $MAXCONTENT; $j++) {
      if(getenv("Q{$i}_CONTENT{$j}")!==false){
        $raw_content = getenv("Q{$i}_CONTENT{$j}");
        $content = (object)[];
        if(startsWith($raw_content,"text;")){
          $content->type = "text";
          $content->text = explode(";",$raw_content,2)[1];
          array_push($quiz->contents,$content);
        }
        elseif(startsWith($raw_content,"image;")){
          $content->type = "image";
          $content->url = explode(";",$raw_content,2)[1];
          array_push($quiz->contents,$content);
        }
      }
    }
    
    array_push($config->quizzes,$quiz);
  }
  
}
echo "var config = ".json_encode($config);
?>
