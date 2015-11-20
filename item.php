<?php
require './src/Entry.php';

$local_id = "";

if (isset($_GET['l']) && $_GET['l'] != "") {
    $local_id = $_GET['l'];
} else {
    // Go to 404
}

$entries = portfolio\Entry::getAllEntries();
if ($entries == NULL) {
    // Go to 503
}
$entry = portfolio\Entry::getEntryById($entries, $local_id);
if ($entry == NULL) {
    /// Go to 404
}
?>

<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <title><?php echo $entry->title; ?> | Raed's Lab</title>
        <link rel="stylesheet" href="http://dhbhdrzi4tiry.cloudfront.net/cdn/sites/foundation.min.css">
        <link rel="stylesheet" href="css/item.css">
    </head>
    <body>
        <div class="top-bar">
            <div class="row">
                <div class="top-bar-left">
                    <div class="text-menu">Raed's Lab</div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="medium-6 columns">
                <img class="" id="mainImg" src="<?php echo $entry->image_main; ?>"
                     alt="<?php echo $entry->image_alt; ?>">
            </div>
            <div class="medium-6 large-5 columns">
                <h3><?php echo $entry->title; ?></h3>
                <p><?php echo $entry->description; ?></p>

                <a href="<?php echo $entry->link_demo; ?>" id="demo-link"  class="button large expanded">Demo Link</a>
                <a href="<?php echo $entry->link_github; ?>" class="button large expanded">Github</a>

                <div class="small button-group">
                    <a class="resp-sharing-button__link" href="https://facebook.com/sharer/sharer.php?u=<?php echo urlencode("http://raed.it/lab?l=" . $entry->id); ?>" target="_blank"><div class="resp-sharing-button resp-sharing-button--facebook resp-sharing-button--medium">
                            Share on Facebook
                        </div>
                    </a>
                    <a class="resp-sharing-button__link" href="https://twitter.com/intent/tweet/?text=<?php echo urlencode("http://raed.it/lab?l=" . $entry->description_short); ?>&url=<?php echo urlencode("http://raed.it/lab?l=" . $entry->id); ?>" target="_blank"><div class="resp-sharing-button resp-sharing-button--twitter resp-sharing-button--medium">
                            Share on Twitter
                        </div>
                    </a>
                    <a class="resp-sharing-button__link" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode("http://raed.it/lab?l=" . $entry->id); ?>&summary=<?php echo urlencode("http://raed.it/lab?l=" . $entry->description_short); ?>" target="_blank"><div class="resp-sharing-button resp-sharing-button--linkedin resp-sharing-button--medium">
                            Share on Linkedin
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="column row">
            <br>
            <ul class="tabs" data-tabs id="example-tabs">
                <li class="tabs-title is-active"><a href="#panel1" aria-selected="true">Reviews</a></li>
                <li class="tabs-title"><a href="#panel2">Similar Projects</a></li>
            </ul>
            <div class="tabs-content" data-tabs-content="example-tabs">
                <div class="tabs-panel is-active" id="panel1">
                    <h4>Reviews</h4>
                    <div class="media-object">
                        <div class="media-object-section">
                            <h5>Mike Stevenson</h5>
                            <p>
                                I'm going to improvise. Listen, there's something you
                                should know about me... about inception. An idea is like a virus,
                                resilient, highly contagious. The smallest seed of an idea can grow.
                                It can grow to define or destroy you.
                            </p>
                        </div>
                    </div>

                    <form>
                        <label>
                            My Review
                            <textarea placeholder="None"></textarea>
                        </label>
                        <button type="submit" class="button">Submit Review</button>
                    </form>

                </div>
                <div class="tabs-panel" id="panel2">
                    <div class="row medium-up-3 large-up-5">
                        <?php
                        if (count($entries) > 5) {
                            $max = 5;
                        } else {
                            $max = count($entries);
                        }
                        $similar = array_rand($entries, $max);


                        foreach ($similar as $ex) {
                            if ($entries[$ex]->id != $local_id) {
                                ?>
                                <div class="column">
                                    <img class="thumbnail" src="<?php echo $entries[$ex]->image_main; ?>"
                                         alt="<?php echo $entries[$ex]->image_alt; ?>"
                                         >
                                    <h5><?php echo $entries[$ex]->title; ?></h5>
                                    <p> 
                                        <?php echo $entries[$ex]->description_short; ?>
                                    </p>
                                    <a href="http://raed.it/lab?l=<?php echo $entries[$ex]->id; ?>" class="button tiny expanded">Check</a>
                                </div>
                                <?php
                            }
                        }
                        ?>

                    </div>
                </div>
            </div>
        </div>
        <div class="row column">
            <hr>
            <ul class="menu">
                <li>Raed's Lab</li>
                <li><a href="http://raed.it">Home</a></li>
                <li><a href="http://raed.it/blog">Blog</a></li>
                <li><a href="https://github.com/RaedsLab">Github</a></li>
                <li class="float-right">Copyleft <?php echo date('Y'); ?></li>
            </ul>
        </div>
        <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
        <script src="http://dhbhdrzi4tiry.cloudfront.net/cdn/sites/foundation.js"></script>
        <script>
            $(document).foundation();
        </script>
    </body>
</html>
