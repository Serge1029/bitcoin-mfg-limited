   <style type="text/css">

        @media only screen and (max-width: 767px) {

        @php
            foreach ($sliders as $slider){
                $title_size = $slider->title_size*.5;


                if ($title_size <12){
                    $title_size = 12;
                }
                echo "
                .title".$slider->id."{
                    font-size:".$title_size."px!important;
                }
                ";
            }
        @endphp
}

        @media only screen and (min-width: 768px) and (max-width: 991px) {

        @php
            foreach ($sliders as $slider){

                $title_size = $slider->title_size*.7;

                echo "
                .title".$slider->id."{
                    font-size:".$title_size."px!important;
                }
                ";
            }
        @endphp
}

    </style>