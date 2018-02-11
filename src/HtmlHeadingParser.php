<?php

namespace IbraheemGhazi\HeadingParser;

use IbraheemGhazi\HeadingParser\HtmlHeading;

class HtmlHeadingParser{
   
      
	/**
     * parse html code and extract Heading from H2 to H6 as content table.
     *
     * @param  string  $code html code represent a topic
     * @return array
     */
   public static function parse($code){
	   
	    preg_match_all('|<\s*h[2-6](?:.*)>(.*)</\s*h|Ui', $code, $matches);

        $h=[];
        foreach ($matches[0] as $idx=>$head){
            if(strpos($head, '<h2') === 0){
                $hobj =  new HtmlHeading();
                $hobj->type = 2;
                $hobj->text = $matches[1][$idx];
                $h[] = $hobj;
            }elseif(strpos($head, '<h3') === 0){
                $hobj =  new HtmlHeading();
                $hobj->type = 3;
                $hobj->text = $matches[1][$idx];

                if(end($h) && end($h)->type != $hobj->type){
                    $lastH2 = end($h);
                    if($lastH2){
                        $lastH2->childrens[]=$hobj;
                    }
                }else{
                    $h[]=$hobj;
                }

            }
            elseif(strpos($head, '<h4') === 0){
                $hobj =  new HtmlHeading();
                $hobj->type = 4;
                $hobj->text = $matches[1][$idx];

                if(end($h) && end($h)->type != $hobj->type){
                    $lastH2 = end($h);
                    if(end($lastH2->childrens) && end($lastH2->childrens)->type != $hobj->type){
                        $lastH3 = end($lastH2->childrens);
                        $lastH3->childrens[]=$hobj;
                    }else{
                        $lastH2->childrens[]=$hobj;
                    }
                }else{
                    $h[]=$hobj;
                }

            }
            elseif(starts_with($head,'<h5')){
                $hobj =  new Heading();
                $hobj->type = 5;
                $hobj->text = $matches[1][$idx];

                if(end($h) && end($h)->type != $hobj->type){
                    $lastH2 = end($h);
                    if($lastH2 && end($lastH2->childrens) && end($lastH2->childrens)->type != $hobj->type){
                        $lastH3 = end($lastH2->childrens);
                        if($lastH3 && end($lastH3->childrens) && end($lastH3->childrens)->type != $hobj->type){
                            $lastH4 = end($lastH3->childrens);
                            $lastH4->childrens[]=$hobj;
                        }else{
                            $lastH3->childrens[]=$hobj;
                        }
                    }else{
                        $lastH2->childrens[]=$hobj;
                    }
                }else{
                    $h[]=$hobj;
                }

            }
            elseif(starts_with($head,'<h6')){
                $hobj =  new HtmlHeading();
                $hobj->type = 6;
                $hobj->text = $matches[1][$idx];

                if(end($h) && end($h)->type != $hobj->type){
                    $lastH2 = end($h);
                    if($lastH2 && end($lastH2->childrens) && end($lastH2->childrens)->type != $hobj->type){
                        $lastH3 = end($lastH2->childrens);
                        if($lastH3 && end($lastH3->childrens) && end($lastH3->childrens)->type != $hobj->type){
                            $lastH4 = end($lastH3->childrens);
                            if($lastH4 && end($lastH4->childrens)  && end($lastH4->childrens)->type != $hobj->type){
                                $lastH5 = end($lastH4->childrens);
                                $lastH5->childrens[]=$hobj;
                            }else{
                                $lastH4->childrens[]=$hobj;
                            }
                        }else{
                            $lastH3->childrens[]=$hobj;
                        }
                    }else{
                        $lastH2->childrens[]=$hobj;
                    }
                }else{
                    $h[]=$hobj;
                }

            }
        }
	   return $h;
   }
}
