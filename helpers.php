<?php
   
    function getCardsArrayFromRepeater($cards){
        $returnCards = [];
        foreach ($cards as $card){
            array_push($returnCards, array('Card' => $card));
        }
        
        return $returnCards;
    }

    function getCardTimelineFromArray($card){
        $cardArray =  [
            'card' => [
                'id'        => $card['id'],
                'info-text' => $card['info-text'],
                'title'     => $card['title'],
                'bg-dark'   => false,
                'content'   => [
                    'texts' => $card['texts']
                ]
            ],
        ];
        return $cardArray;
        
        
       
    }   


    function generateCardTimelineFromArray($boCardsArray){
        $resultArray = array_map('getCardTimelineFromArray', $boCardsArray);
        
        return $resultArray;
    }

    function getCardOpFromArray($card){
        $cardArray =  [
            'columns'   => '10',
                        'bg-dark'   => true,
                        'info-text' => $card['info-text'],
                        'title'     => $card['title'],
                        'content'   => [
                            [
                                'text'  => $card['text'],
                                'button' => [
                                    'url' => $card['cta_target'],
                                    'title' => $card['cta_text']
                                ] 
                            ]
                        ]
        ];
        return fullInfoTextCard($cardArray);
        
        
       
    }   


    function generateCardOpFromArray($boCardsArray){
        $resultArray = array_map('getCardOpFromArray', $boCardsArray);
        
        return $resultArray;
    }




    function getSlideFromArray($slide){
        return array(
            'title'     => $slide['text'],
            'text'      => '',
            'info_txt'  => $slide['title'],
            'image'     => array(
                'url'   => $slide['image_desktop']['url'],
                'alt'   => $slide['image_desktop']['alt']
            ),
            'cta'       => array(
                'text'  => $slide['button']['text'],
                'url'   => $slide['button']['link']
            )
        );
    }   


    function generateSliderArray($boSliderArray){
        $resultArray = array_map('getSlideFromArray', $boSliderArray);
        
        return $resultArray;
    }
  
  
    function generateImageTag($image, $class = '') {
        $image_info = array(
            'url'   => $image['url'],
            'title' => $image['title'],
            'alt'   => $image['alt'],
            'name'  => $image['name']
        );

        $image_tile = $image_info['alt'] != '' ? $image_info['alt'] : (
            $image_info['title'] != '' ? $image_info['title'] : $image_info['name']
        );

        echo "<img class=\"$class\" src=\"{$image_info['url']}\" alt=\"$image_tile\">";
    }
    add_action('generateImgTag', 'generateImageTag', 10, 2);

    function generateImageTagByAssets($image, $alt="Image name", $class = '') { ?>
        <img class="<?= $class; ?>" src="<?= get_theme_file_uri('/assets/images/' . $image); ?>" alt="<?= $alt; ?>">
    <?php }
    add_action('generateImgTagAssets', 'generateImageTagByAssets', 10, 3);

?>