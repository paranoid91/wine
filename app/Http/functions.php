<?php

//if(!function_exists('get_cat_by_parent')){
//    /**
//     * @param $categories
//     * @param $parent
//     * @return array
//     */
//    function get_cat_by_parent($categories, $parent){
//        $result = [];
//        if(count($categories) > 0){
//            $i = 0;
//            foreach($categories as $cat){
//                if($cat->parent == $parent):
//                $result[$cat->id] = trans('front.'.$cat->name);
//                endif;
//                $i++;
//            }
//        }
//
//        return $result;
//    }
//}


if(!function_exists('list_years')){
    /**
     * @param $start
     * @param $end
     * @param string $placeholder
     * @return array
     */
    function list_years($start, $end, $placeholder = ''){
        $years = [''=>$placeholder];
        for($i=$start;$i<=$end;$i++){
            $years[$i]=$i;
        }
        return $years;
    }
}
if(!function_exists('list_years_desc')){
    /**
     * @param $start
     * @param $end
     * @param string $placeholder
     * @return array
     */
    function list_years_desc($start, $end, $placeholder = ''){
        $years = [''=>$placeholder];
        for($i=$start;$i>=$end;$i--){
            $years[$i]=$i;
        }
        return $years;
    }
}

if(!function_exists('get_rating')){
    /**
     * @param $product
     * @return string
     */
    function get_rating($product){
          $rating = ($product->averageRating(5)) ? $product->averageRating(5) : 0;
          if($product){
              $output = '<ul class="star_rating" data-id="'.$product->id.'" data-rating="'.$rating.'" data-action="'.action('Frontend\ProductsController@addRating').'" data-token="'.csrf_token().'">';
              for($i=1;$i<=5;$i++){
                  $add = (Auth::check()) ? 'onClick="addRating('.$i.')"' : '';
                  if($product->averageRating(5)>=$i):
                      $output .= '<li '.$add.'><i class="fa fa-star"></i></li>';
                  elseif($product->averageRating(5) > ($i - 1) && $product->averageRating(5) < $i):
                      $output .= '<li '.$add.'><i class="fa fa-star-half-o"></i></li>';
                  else:
                      $output .= '<li '.$add.'"><i class="fa fa-star-o"></i></li>';
                  endif;
              }
              $output .= '</ul>';
              $output .= '<script>
                            $(function(){

                                $(".star_rating").hover(function(){
                                    $(".star_rating li").hover(function(){
                                    for(var i = 0; i<5; i++){
                                       if(i<=$(this).index()){
                                          $(".star_rating li:eq("+i+") i").removeClass("fa-star-o").removeClass("fa-star-half-o").addClass("fa-star");
                                       }else{
                                          $(".star_rating li:eq("+i+") i").removeClass("fa-star").removeClass("fa-star-half-o").addClass("fa-star-o");
                                       }
                                    }
                                });
                                },function(){
                                   var rating = $(this).attr("data-rating");
                                   for(var i = 1; i<=5; i++){
                                    if(rating >= i){
                                       $(".star_rating li:nth-child("+i+") i").removeClass("fa-star-o").removeClass("fa-star-half-o").addClass("fa-star");
                                    }else if(rating > (i-1) && rating < i){
                                       $(".star_rating li:nth-child("+i+") i").removeClass("fa-star-o").removeClass("fa-star").addClass("fa-star-half-o");
                                    }else{
                                       $(".star_rating li:nth-child("+i+") i").removeClass("a-star-half-o").removeClass("fa-star").addClass("fa-star-o");
                                    }
                                   }
                                });
                            });
                          </script>';
              return $output;
          }
    }


}
