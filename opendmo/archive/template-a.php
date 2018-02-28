<?php

get_header();

?>

<div id="opendmo_archive_content">

    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
                
                <header class="page-header">

                    <?php

                        the_archive_title( '<h1 class="page-title">', '</h1>' );
                        the_archive_description( '<div class="taxonomy-description"><p>', '</p></div>' );

                    ?>
                </header>

                <?php 
                
                    opendmo_archive_post(); 
                
                ?>
            

            </div>
        </main>
    </div>
    
    <div class="clear opendmo_clear"></div>
        
</div>

<?php

get_sidebar();
get_footer();
