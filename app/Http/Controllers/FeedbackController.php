<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Product;
use App\Feedback;

class FeedbackController extends Controller
{

    public function feedback($id){
      $prod=Product::find($id);
      return view('users.feedback')->with(['id'=>$id,'val'=>$prod->seller_id]);
    }
    public function postfeedback(Request $request){
       $this->validate($request,array(
    'feedback'=>'required',

    ));









// $str=$_GET['feedback'];
$str=$request->feedback;
$words = explode(" ",$str);
$sorted_list = array("-1" => "-1");

$counter=0;

$sorted = fopen("sorted.txt","r") or die("unable to open sorted");
// fread($sorted, filesize("sorted.txt"));
$fword = fscanf($sorted, "%s\n");
while(strcmp($fword[0], "00000"))
{
  $sorted_list[$fword[0]]=++$counter;
  $fword = fscanf($sorted, "%s\n");
}
fclose($sorted);




$MPfile = fopen("positiveProbOfWords.txt","r") or  die("unable to open positiveprob file");
//fread($MPfile, filesize("positiveProbOfWords.txt"));

$MP = array("-1" => "-1");

$line = fscanf($MPfile, "%d %f\n");
$rank=$line[0];
$prob=$line[1];
while(!feof($MPfile))
{
  $MP[$rank]=$prob;
  $line = fscanf($MPfile, "%d %f\n");
  $rank=$line[0];
  $prob=$line[1];
}
fclose($MPfile);






$MNfile = fopen("negativeProbOfWords.txt","r") or  die("unable to open negative prob file");
//fread($MPfile, filesize("positiveProbOfWords.txt"));

$MN = array("-1" => "-1");

$line = fscanf($MNfile, "%d %f\n");
$rank=$line[0];
$prob=$line[1];

while(!feof($MNfile))
{
  $MN[$rank]=$prob;
  $line = fscanf($MNfile, "%d %f\n");
  $rank=$line[0];
  $prob=$line[1];
}
fclose($MNfile);

$positive_prob = 1.0;
$negative_prob = 1.0;

foreach($words as $word)
{
  if(array_key_exists($word, $sorted_list))
  {
    $rank = $sorted_list[$word];
    if(array_key_exists($rank, $MP))
    {
      $positive_prob *= $MP[$rank];
    }
    else
    {
      $positive_prob *= 1.0/(20578+94191);
    }
    if(array_key_exists($rank, $MN))
    {
      $negative_prob *= $MN[$rank];
    }
    else
    {
      $negative_prob *= 1.0/(20578+93752);
    }
    $positive_prob*=(5331/(5331*2.0));
    $negative_prob*=(5331/(5331*2.0));
  }

}
$polarity=1;
if($negative_prob > $positive_prob)
{
  $polarity = 0;
  $pos_exp=(int)log10($positive_prob);
      $neg_exp=(int)log10($negative_prob);
      $pos_man=$positive_prob/(pow(10,$pos_exp));
      $neg_man=$negative_prob/(pow(10,$neg_exp));
      $neg_exp=abs($neg_exp);
      $pos_exp=abs($pos_exp);
      if($pos_exp>=$neg_exp+4)
      $confidence=95;
      else if($pos_exp>=$neg_exp+3)
      $confidence=85;
      else if($pos_exp>=$neg_exp+2)
      $confidence=75;
      else if($pos_exp>=$neg_exp+1)
      $confidence=70;
      else
      $confidence=55+($pos_man-$neg_man)/10;
}
else
{
  $pos_exp=(int)log10($positive_prob);
      $neg_exp=(int)log10($negative_prob);
      $pos_man=$positive_prob/(pow(10,$pos_exp));
      $neg_man=$negative_prob/(pow(10,$neg_exp));
      $neg_exp=abs($neg_exp);
      $pos_exp=abs($pos_exp);
      if($pos_exp+4<=$neg_exp)
      $confidence=95;
      else if($pos_exp+3<=$neg_exp)
      $confidence=85;
      else if($pos_exp+2<=$neg_exp)
      $confidence=75;
      else if($pos_exp+1<=$neg_exp)
      $confidence=70;
      else
      $confidence=55+($pos_man-$neg_man)/10;
}

// echo $polarity.','.$confidence;





    //store in data base
        $feed = new Feedback;
    $feed->item_id=$request->itemid;
    $feed->body = $request->feedback;
    $feed->seller_id = $request->selid;
    $feed->buyer_id = Auth::user()->id;
    $feed->polarity = $polarity;
    $feed->confidence=$confidence;


    $feed->save();

      return redirect()->to('/profile') ;
    }




}
