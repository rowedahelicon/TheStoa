<?php
$markdown = null;
if (isset($_SERVER['REQUEST_URI']) && $_SERVER['REQUEST_URI'] != '/')
{
    if (file_exists(getcwd().$_SERVER['REQUEST_URI'].'.md'))
    {
        $markdown = getcwd().$_SERVER['REQUEST_URI'].'.md';
    }
    else
    {
        header('HTTP/1.0 404 Not Found');
    }
}

require ('../vendor/autoload.php');
use League\CommonMark\CommonMarkConverter;

$current_page = (((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://").$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

(array) $header = array('title' => 'The Stoa', 'url' => $current_page, 'description' => 'A blog about digital/gaming communities and the importance they have.');
if (!is_null($markdown) && file_exists(getcwd().$_SERVER['REQUEST_URI'].'.json')) $header = array_merge($header, json_decode(file_get_contents(getcwd().$_SERVER['REQUEST_URI'].'.json'), TRUE)); 
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo htmlspecialchars($header['title']); ?></title>

		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://thestoa.blog/blog.min.css">
        <link rel="icon" type="image/png" sizes="32x32" href="https://thestoa.blog/stoa_fav_32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="https://thestoa.blog/stoa_fav_16.png">
        <meta name="msapplication-TileColor" content="#272d36">
        <meta name="theme-color" content="#272d36">
        <meta name="keywords" content="blog, team fortress 2, community, social media, networking, lgbt">
        <meta name="description" content="<?php echo htmlspecialchars($header['description']); ?>">
        <meta property="og:url" content="<?php echo htmlspecialchars($header['url']); ?>">
        <meta property="og:type" content="website">
        <meta property="og:title" content="<?php echo htmlspecialchars($header['title']); ?>">
        <meta property="og:description" content="<?php echo htmlspecialchars($header['description']); ?>">
        <meta property="og:image" content="https://thestoa.blog/stoa_og.png">
        <meta name="twitter:card" content="summary_large_image">
        <meta property="twitter:domain" content="thestoa.blog">
        <meta property="twitter:url" content="<?php echo htmlspecialchars($header['url']); ?>">
        <meta name="twitter:site" content="@rowedahelicon">
        <meta name="twitter:title" content="<?php echo htmlspecialchars($header['title']); ?>">
        <meta name="twitter:description" content="<?php echo htmlspecialchars($header['description']); ?>">
        <meta name="twitter:image" content="https://thestoa.blog/stoa_og.png">
        <meta name="twitter:image:alt" content="A preview">
        <?php if (!is_null($markdown)): ?>
        <?php $published_date = explode("/", $_SERVER['REQUEST_URI']); ?>

        <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "Article",
            "mainEntityOfPage": {
                "@type": "WebPage",
                "@id": "<?php echo htmlspecialchars($header['url']); ?>"
            },
            "headline": "<?php echo htmlspecialchars($header['title']); ?>",
            "description": "<?php echo htmlspecialchars($header['description']); ?>",
            "image": "https://thestoa.blog/stoa_og.png",  
            "author": {
                "@type": "Person",
                "name": "Rowedahelicon",
                "url": "https://rowdythecrux.dev"
            },  
            "publisher": {
                "@type": "Organization",
                "name": "The Stoa",
                "logo": {
                    "@type": "ImageObject",
                    "url": "ttps://thestoa.blog/stoa_fav_16.png"
                }
            },
            "datePublished": "<?php echo $published_date[1].'-'.$published_date[2].'-'.$published_date[3]; ?>",
            "dateModified": "<?php echo date("Y-m-d", filemtime(getcwd().$_SERVER['REQUEST_URI'].'.md')); ?>"
        }
        </script>
        <?php endif; ?>
    </head>
    <body>
        <header>
            <a href="https://thestoa.blog"><h1>The Stoa</h1></a>
            <span style="color:#C9CBCD;"><i>(Noun, Ancient Greek) A sheltered walkway or porch often used as common spaces.</i></span>
            <br>
            <i>A blog about digital/gaming communities and the importance they have.</i>
        </header>
        <main>
        <?php  if (!is_null($markdown)): ?>
        <?php $converter = new CommonMarkConverter(); echo $converter->convertToHtml(file_get_contents($markdown)); ?>
        <?php else: ?>
        <section>
            <h2>Posts</h2>
            <span class="gray-1"><b>01/30/2024</b></span> » <a href="/2024/01/30/preamble">Preamble (Read me first!)</a>
        </section>
        <section>
            <h2>Relevant Articles</h2>
            <span class="gray-1"><b>07/31/2007</b></span> » <a href="https://www.npr.org/2007/07/31/12263532/alter-egos-in-a-virtual-world">NPR - Alter Egos in a Virtual World</a><br>
            <span class="gray-1"><b>04/29/2020</b></span> » <a href="https://www.pcgamer.com/blizzard-co-founder-believes-accessibility-has-made-world-of-warcraft-less-social/">PCGamer - Blizzard co-founder believes accessibility has made World of Warcraft less social</a>
        </section>
        <section>
            <h2>Inspiration</h2>
            <span class="gray-1"><b>11/27/2023</b></span> » <a href="https://earthboundusa.com/">Earthbound USA</a> <br>
            <span class="gray-1"><b>01/13/2024</b></span> » <a href="/2024/01/15/quotes">Inspirational Quotes and Events</a> (Updated 1/15/2024)
        </section>
        <?php endif; ?>
        </main>
        <hr class="footer">
        <footer>
            <div>
                <b>Maintained by <a href="https://rowdythecrux.dev">Rowedahelicon</a></b><div class="float-right">Inquiries/Comments: <a href="mailto:hello@rowdythecrux.dev">hello@rowdythecrux.dev</a></div>
            </div>
            <div>Support me? <a href="https://ko-fi.com/rowedahelicon">Ko-Fi</a> | <a href="https://patreon.com/rowedahelicon">Patreon</a></div>
            <br>
            <div>Dedicated to members of the <a href="https://scg.wtf">Southern Cross Gaming</a> community and to the late Jason Rowe.</div>
            <div>Thanks to my friends, my family, and to all whom I've had the pleasure of interacting with on the internet.</div>
            <br>
            <div>
                Markdown css modified from <a href="https://markdowncss.github.io/retro/">Retro</a>
                <div class="float-right"><a href="https://thestoa.blog/atom.xml">RSS</a> | <a href="https://validator.w3.org/nu/?doc=<?php echo urlencode($current_page); ?>">HTML</a> | <a href="http://jigsaw.w3.org/css-validator/validator?lang=en&profile=css3svg&uri=<?php echo urlencode($current_page); ?>&usermedium=all&vextwarning=&warning=1">CSS</a> | <a href="https://github.com/rowedahelicon/TheStoa">Github</a></div>
            </div>
        </footer>
    </body>
</html>