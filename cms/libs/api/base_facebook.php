


<!DOCTYPE html>
<html>
  <head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# githubog: http://ogp.me/ns/fb/githubog#">
    <meta charset='utf-8'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>php-sdk/src/base_facebook.php at master · facebook/php-sdk · GitHub</title>
    <link rel="search" type="application/opensearchdescription+xml" href="/opensearch.xml" title="GitHub" />
    <link rel="fluid-icon" href="https://github.com/fluidicon.png" title="GitHub" />
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />

    
    

    <meta content="authenticity_token" name="csrf-param" />
<meta content="IQ0vekIIZfcIyjNGadr9DarmLnED43fFzXCGs9d7aJw=" name="csrf-token" />

    <link href="https://a248.e.akamai.net/assets.github.com/stylesheets/bundles/github-9b7be9f578b4af170903c220215ad8680a97d61e.css" media="screen" rel="stylesheet" type="text/css" />
    <link href="https://a248.e.akamai.net/assets.github.com/stylesheets/bundles/github2-02faadd95ff1183c3df5da2e69d237d00cef71b0.css" media="screen" rel="stylesheet" type="text/css" />
    

    <script src="https://a248.e.akamai.net/assets.github.com/javascripts/bundles/frameworks-7b5694dece50ddf8456fccf7884bd83581722a3f.js" type="text/javascript"></script>
    
    <script defer="defer" src="https://a248.e.akamai.net/assets.github.com/javascripts/bundles/github-ed88cce616e7fb55dea93e5ffadc963054853f83.js" type="text/javascript"></script>
    

      <link rel='permalink' href='/facebook/php-sdk/blob/6c82b3fdfb8efd27751de028d75fd3ab1f2c1ade/src/base_facebook.php'>
    <meta property="og:title" content="php-sdk"/>
    <meta property="og:type" content="githubog:gitrepository"/>
    <meta property="og:url" content="https://github.com/facebook/php-sdk"/>
    <meta property="og:image" content="https://a248.e.akamai.net/assets.github.com/images/gravatars/gravatar-140.png?1334862345"/>
    <meta property="og:site_name" content="GitHub"/>
    <meta property="og:description" content="We have created a new repository for this project: https://github.com/facebook/facebook-php-sdk.  Please update anything you have pointing at this repostory to this location before April 1, 2012."/>

    <meta name="description" content="We have created a new repository for this project: https://github.com/facebook/facebook-php-sdk.  Please update anything you have pointing at this repostory to this location before April 1, 2012." />
  <link href="https://github.com/facebook/php-sdk/commits/master.atom" rel="alternate" title="Recent Commits to php-sdk:master" type="application/atom+xml" />

  </head>


  <body class="logged_out page-blob windows vis-public env-production " data-blob-contribs-enabled="yes">
    <div id="wrapper">

    
    
    

      <div id="header" class="true clearfix">
        <div class="container clearfix">
          <a class="site-logo" href="https://github.com">
            <!--[if IE]>
            <img alt="GitHub" class="github-logo" src="https://a248.e.akamai.net/assets.github.com/images/modules/header/logov7.png?1334862346" />
            <img alt="GitHub" class="github-logo-hover" src="https://a248.e.akamai.net/assets.github.com/images/modules/header/logov7-hover.png?1334862346" />
            <![endif]-->
            <img alt="GitHub" class="github-logo-4x" height="30" src="https://a248.e.akamai.net/assets.github.com/images/modules/header/logov7@4x.png?1334862346" />
            <img alt="GitHub" class="github-logo-4x-hover" height="30" src="https://a248.e.akamai.net/assets.github.com/images/modules/header/logov7@4x-hover.png?1334862346" />
          </a>

                  <!--
      make sure to use fully qualified URLs here since this nav
      is used on error pages on other domains
    -->
    <ul class="top-nav logged_out">
        <li class="pricing"><a href="https://github.com/plans">Signup and Pricing</a></li>
        <li class="explore"><a href="https://github.com/explore">Explore GitHub</a></li>
      <li class="features"><a href="https://github.com/features">Features</a></li>
        <li class="blog"><a href="https://github.com/blog">Blog</a></li>
      <li class="login"><a href="https://github.com/login?return_to=%2Ffacebook%2Fphp-sdk%2Fblob%2Fmaster%2Fsrc%2Fbase_facebook.php">Login</a></li>
    </ul>



          
        </div>
      </div>

      

            <div class="site hfeed" itemscope itemtype="http://schema.org/WebPage">
      <div class="container hentry">
        <div class="pagehead repohead instapaper_ignore readability-menu">
        <div class="title-actions-bar">
          



              <ul class="pagehead-actions">


          <li><a href="/login?return_to=%2Ffacebook%2Fphp-sdk" class="minibutton btn-watch watch-button entice tooltipped leftwards" rel="nofollow" title="You must be logged in to use this feature"><span><span class="icon"></span>Watch</span></a></li>
          <li><a href="/login?return_to=%2Ffacebook%2Fphp-sdk" class="minibutton btn-fork fork-button entice tooltipped leftwards" rel="nofollow" title="You must be logged in to use this feature"><span><span class="icon"></span>Fork</span></a></li>


      <li class="repostats">
        <ul class="repo-stats">
          <li class="watchers ">
            <a href="/facebook/php-sdk/watchers" title="Watchers" class="tooltipped downwards">
              4,063
            </a>
          </li>
          <li class="forks">
            <a href="/facebook/php-sdk/network" title="Forks" class="tooltipped downwards">
              851
            </a>
          </li>
        </ul>
      </li>
    </ul>

          <h1 itemscope itemtype="http://data-vocabulary.org/Breadcrumb" class="entry-title">
            <span class="mini-icon public-repo"></span>
            <span class="author vcard">
<a href="/facebook" class="url fn" itemprop="url" rel="author">              <span itemprop="title">facebook</span>
              </a></span> /
            <strong><a href="/facebook/php-sdk" class="js-current-repository">php-sdk</a></strong>
          </h1>
        </div>

          

  <ul class="tabs">
    <li><a href="/facebook/php-sdk" class="selected" highlight="repo_sourcerepo_downloadsrepo_commitsrepo_tagsrepo_branches">Code</a></li>
    <li><a href="/facebook/php-sdk/network" highlight="repo_network">Network</a>
    <li><a href="/facebook/php-sdk/pulls" highlight="repo_pulls">Pull Requests <span class='counter'>5</span></a></li>



    <li><a href="/facebook/php-sdk/graphs" highlight="repo_graphsrepo_contributors">Graphs</a></li>

  </ul>
 
<div class="frame frame-center tree-finder" style="display:none"
      data-tree-list-url="/facebook/php-sdk/tree-list/6c82b3fdfb8efd27751de028d75fd3ab1f2c1ade"
      data-blob-url-prefix="/facebook/php-sdk/blob/6c82b3fdfb8efd27751de028d75fd3ab1f2c1ade"
    >

  <div class="breadcrumb">
    <span class="bold"><a href="/facebook/php-sdk">php-sdk</a></span> /
    <input class="tree-finder-input js-navigation-enable" type="text" name="query" autocomplete="off" spellcheck="false">
  </div>

    <div class="octotip">
      <p>
        <a href="/facebook/php-sdk/dismiss-tree-finder-help" class="dismiss js-dismiss-tree-list-help" title="Hide this notice forever" rel="nofollow">Dismiss</a>
        <span class="bold">Octotip:</span> You've activated the <em>file finder</em>
        by pressing <span class="kbd">t</span> Start typing to filter the
        file list. Use <span class="kbd badmono">↑</span> and
        <span class="kbd badmono">↓</span> to navigate,
        <span class="kbd">enter</span> to view files.
      </p>
    </div>

  <table class="tree-browser" cellpadding="0" cellspacing="0">
    <tr class="js-header"><th>&nbsp;</th><th>name</th></tr>
    <tr class="js-no-results no-results" style="display: none">
      <th colspan="2">No matching files</th>
    </tr>
    <tbody class="js-results-list js-navigation-container">
    </tbody>
  </table>
</div>

<div id="jump-to-line" style="display:none">
  <h2>Jump to Line</h2>
  <form accept-charset="UTF-8">
    <input name="utf8" type="hidden" value="&#x2713;" />
    <input class="textfield" type="text">
    <div class="full-button">
      <button type="submit" class="classy">
        <span>Go</span>
      </button>
    </div>
  </form>
</div>


<div class="subnav-bar">

  <ul class="actions subnav">
    <li><a href="/facebook/php-sdk/tags" class="" highlight="repo_tags">Tags <span class="counter">14</span></a></li>
    <li><a href="/facebook/php-sdk/downloads" class="blank downloads-blank" highlight="repo_downloads">Downloads <span class="counter">0</span></a></li>
    
  </ul>

  <ul class="scope">
    <li class="switcher">

      <div class="context-menu-container js-menu-container">
        <a href="#"
           class="minibutton bigger switcher js-menu-target js-commitish-button btn-branch repo-tree"
           data-master-branch="master"
           data-ref="master">
          <span><span class="icon"></span><i>branch:</i> master</span>
        </a>

        <div class="context-pane commitish-context js-menu-content">
          <a href="javascript:;" class="close js-menu-close"></a>
          <div class="context-title">Switch Branches/Tags</div>
          <div class="context-body pane-selector commitish-selector js-filterable-commitishes">
            <div class="filterbar">
              <input type="text" id="context-commitish-filter-field" class="commitish-filter" placeholder="Filter branches/tags" />

              <ul class="tabs">
                <li><a href="#" data-filter="branches" class="selected">Branches</a></li>
                <li><a href="#" data-filter="tags">Tags</a></li>
              </ul>
            </div>

              <div class="commitish-item branch-commitish selector-item">
                <h4>
                    <a href="/facebook/php-sdk/blob/master/src/base_facebook.php" data-name="master" rel="nofollow">master</a>
                </h4>
              </div>

              <div class="commitish-item tag-commitish selector-item">
                <h4>
                    <a href="/facebook/php-sdk/blob/v3.1.1/src/base_facebook.php" data-name="v3.1.1" rel="nofollow">v3.1.1</a>
                </h4>
              </div>
              <div class="commitish-item tag-commitish selector-item">
                <h4>
                    <a href="/facebook/php-sdk/blob/v3.1.0/src/base_facebook.php" data-name="v3.1.0" rel="nofollow">v3.1.0</a>
                </h4>
              </div>
              <div class="commitish-item tag-commitish selector-item">
                <h4>
                    <a href="/facebook/php-sdk/blob/v3.0.1/src/base_facebook.php" data-name="v3.0.1" rel="nofollow">v3.0.1</a>
                </h4>
              </div>
              <div class="commitish-item tag-commitish selector-item">
                <h4>
                    <a href="/facebook/php-sdk/blob/v3.0.0/src/base_facebook.php" data-name="v3.0.0" rel="nofollow">v3.0.0</a>
                </h4>
              </div>
              <div class="commitish-item tag-commitish selector-item">
                <h4>
                    <a href="/facebook/php-sdk/blob/v2.1.2/src/base_facebook.php" data-name="v2.1.2" rel="nofollow">v2.1.2</a>
                </h4>
              </div>
              <div class="commitish-item tag-commitish selector-item">
                <h4>
                    <a href="/facebook/php-sdk/blob/v2.1.1/src/base_facebook.php" data-name="v2.1.1" rel="nofollow">v2.1.1</a>
                </h4>
              </div>
              <div class="commitish-item tag-commitish selector-item">
                <h4>
                    <a href="/facebook/php-sdk/blob/v2.1.0/src/base_facebook.php" data-name="v2.1.0" rel="nofollow">v2.1.0</a>
                </h4>
              </div>
              <div class="commitish-item tag-commitish selector-item">
                <h4>
                    <a href="/facebook/php-sdk/blob/v2.0.7/src/base_facebook.php" data-name="v2.0.7" rel="nofollow">v2.0.7</a>
                </h4>
              </div>
              <div class="commitish-item tag-commitish selector-item">
                <h4>
                    <a href="/facebook/php-sdk/blob/v2.0.6/src/base_facebook.php" data-name="v2.0.6" rel="nofollow">v2.0.6</a>
                </h4>
              </div>
              <div class="commitish-item tag-commitish selector-item">
                <h4>
                    <a href="/facebook/php-sdk/blob/v2.0.4/src/base_facebook.php" data-name="v2.0.4" rel="nofollow">v2.0.4</a>
                </h4>
              </div>
              <div class="commitish-item tag-commitish selector-item">
                <h4>
                    <a href="/facebook/php-sdk/blob/v2.0.3/src/base_facebook.php" data-name="v2.0.3" rel="nofollow">v2.0.3</a>
                </h4>
              </div>
              <div class="commitish-item tag-commitish selector-item">
                <h4>
                    <a href="/facebook/php-sdk/blob/v2.0.2/src/base_facebook.php" data-name="v2.0.2" rel="nofollow">v2.0.2</a>
                </h4>
              </div>
              <div class="commitish-item tag-commitish selector-item">
                <h4>
                    <a href="/facebook/php-sdk/blob/v2.0.1/src/base_facebook.php" data-name="v2.0.1" rel="nofollow">v2.0.1</a>
                </h4>
              </div>
              <div class="commitish-item tag-commitish selector-item">
                <h4>
                    <a href="/facebook/php-sdk/blob/v2.0.0/src/base_facebook.php" data-name="v2.0.0" rel="nofollow">v2.0.0</a>
                </h4>
              </div>

            <div class="no-results" style="display:none">Nothing to show</div>
          </div>
        </div><!-- /.commitish-context-context -->
      </div>

    </li>
  </ul>

  <ul class="subnav with-scope">

    <li><a href="/facebook/php-sdk" class="selected" highlight="repo_source">Files</a></li>
    <li><a href="/facebook/php-sdk/commits/master" highlight="repo_commits">Commits</a></li>
    <li><a href="/facebook/php-sdk/branches" class="" highlight="repo_branches" rel="nofollow">Branches <span class="counter">1</span></a></li>
  </ul>

</div>

  
  
  


          

        </div><!-- /.repohead -->

        





<!-- block_view_fragment_key: views7/v8/blob:v21:ee1f8f5bf88f33278e08966f6dd5b907 -->
  <div id="slider">

    <div class="breadcrumb" data-path="src/base_facebook.php/">
      <b itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="/facebook/php-sdk/tree/6c82b3fdfb8efd27751de028d75fd3ab1f2c1ade" class="js-rewrite-sha" itemprop="url"><span itemprop="title">php-sdk</span></a></b> / <span itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="/facebook/php-sdk/tree/6c82b3fdfb8efd27751de028d75fd3ab1f2c1ade/src" class="js-rewrite-sha" itemscope="url"><span itemprop="title">src</span></a></span> / <strong class="final-path">base_facebook.php</strong> <span class="js-clippy mini-icon clippy " data-clipboard-text="src/base_facebook.php" data-copied-hint="copied!" data-copy-hint="copy to clipboard"></span>
    </div>


      <div class="commit file-history-tease" data-path="src/base_facebook.php/">
        <img class="main-avatar" height="24" src="https://secure.gravatar.com/avatar/a9cce97b982fca68c642b07237629917?s=140&amp;d=https://a248.e.akamai.net/assets.github.com%2Fimages%2Fgravatars%2Fgravatar-140.png" width="24" />
        <span class="author"><a href="/WizKid">WizKid</a></span>
        <time class="js-relative-date " datetime="2012-01-24T15:33:06-08:00" title="2012-01-24 15:33:06">January 24, 2012</time>
        <div class="commit-title">
            <a href="/facebook/php-sdk/commit/6bc64892318622a4111550e79def6e08a4b0a977" class="message">Make sure we delete the Javascript cookie because otherwise we will g…</a>
        </div>

        <div class="participation">
          <p class="quickstat"><a href="#blob_contributors_box" rel="facebox"><strong>9</strong> contributors</a></p>
              <a class="avatar tooltipped downwards" title="ptarjan" href="/facebook/php-sdk/commits/master/src/base_facebook.php?author=ptarjan"><img height="20" src="https://secure.gravatar.com/avatar/b3bb70a4bace7f9bd49f48b149ab95f9?s=140&amp;d=https://a248.e.akamai.net/assets.github.com%2Fimages%2Fgravatars%2Fgravatar-140.png" width="20" /></a>
    <a class="avatar tooltipped downwards" title="oyvindkinsey" href="/facebook/php-sdk/commits/master/src/base_facebook.php?author=oyvindkinsey"><img height="20" src="https://secure.gravatar.com/avatar/fb3ded4d0e7ae262a6dc9ede4abf9f0d?s=140&amp;d=https://a248.e.akamai.net/assets.github.com%2Fimages%2Fgravatars%2Fgravatar-140.png" width="20" /></a>
    <a class="avatar tooltipped downwards" title="JuhQ" href="/facebook/php-sdk/commits/master/src/base_facebook.php?author=JuhQ"><img height="20" src="https://secure.gravatar.com/avatar/f9da2be0d3b55d9ae41f932507f924a7?s=140&amp;d=https://a248.e.akamai.net/assets.github.com%2Fimages%2Fgravatars%2Fgravatar-140.png" width="20" /></a>
    <a class="avatar tooltipped downwards" title="scottmac" href="/facebook/php-sdk/commits/master/src/base_facebook.php?author=scottmac"><img height="20" src="https://secure.gravatar.com/avatar/3c5a0318513620a5d04916e7deee6737?s=140&amp;d=https://a248.e.akamai.net/assets.github.com%2Fimages%2Fgravatars%2Fgravatar-140.png" width="20" /></a>
    <a class="avatar tooltipped downwards" title="jerrycainjr" href="/facebook/php-sdk/commits/master/src/base_facebook.php?author=jerrycainjr"><img height="20" src="https://secure.gravatar.com/avatar/1ff6e4fc5862f200d8d17bb01bc4337a?s=140&amp;d=https://a248.e.akamai.net/assets.github.com%2Fimages%2Fgravatars%2Fgravatar-140.png" width="20" /></a>
    <a class="avatar tooltipped downwards" title="sotarok" href="/facebook/php-sdk/commits/master/src/base_facebook.php?author=sotarok"><img height="20" src="https://secure.gravatar.com/avatar/4564d3601f6230782300dff8499b2d5a?s=140&amp;d=https://a248.e.akamai.net/assets.github.com%2Fimages%2Fgravatars%2Fgravatar-140.png" width="20" /></a>
    <a class="avatar tooltipped downwards" title="brendo" href="/facebook/php-sdk/commits/master/src/base_facebook.php?author=brendo"><img height="20" src="https://secure.gravatar.com/avatar/6be8e584a0f454ac2dc7600bdeaca7b7?s=140&amp;d=https://a248.e.akamai.net/assets.github.com%2Fimages%2Fgravatars%2Fgravatar-140.png" width="20" /></a>
    <a class="avatar tooltipped downwards" title="WizKid" href="/facebook/php-sdk/commits/master/src/base_facebook.php?author=WizKid"><img height="20" src="https://secure.gravatar.com/avatar/a9cce97b982fca68c642b07237629917?s=140&amp;d=https://a248.e.akamai.net/assets.github.com%2Fimages%2Fgravatars%2Fgravatar-140.png" width="20" /></a>
    <a class="avatar tooltipped downwards" title="KirilAngov" href="/facebook/php-sdk/commits/master/src/base_facebook.php?author=KirilAngov"><img height="20" src="https://secure.gravatar.com/avatar/88e3bd41a474e9c1eb00499e013b334a?s=140&amp;d=https://a248.e.akamai.net/assets.github.com%2Fimages%2Fgravatars%2Fgravatar-140.png" width="20" /></a>


        </div>
        <div id="blob_contributors_box" style="display:none">
          <h2>Users on GitHub who have contributed to this file</h2>
          <ul class="facebox-user-list">
            <li>
              <img height="24" src="https://secure.gravatar.com/avatar/b3bb70a4bace7f9bd49f48b149ab95f9?s=140&amp;d=https://a248.e.akamai.net/assets.github.com%2Fimages%2Fgravatars%2Fgravatar-140.png" width="24" />
              <a href="/ptarjan">ptarjan</a>
            </li>
            <li>
              <img height="24" src="https://secure.gravatar.com/avatar/fb3ded4d0e7ae262a6dc9ede4abf9f0d?s=140&amp;d=https://a248.e.akamai.net/assets.github.com%2Fimages%2Fgravatars%2Fgravatar-140.png" width="24" />
              <a href="/oyvindkinsey">oyvindkinsey</a>
            </li>
            <li>
              <img height="24" src="https://secure.gravatar.com/avatar/f9da2be0d3b55d9ae41f932507f924a7?s=140&amp;d=https://a248.e.akamai.net/assets.github.com%2Fimages%2Fgravatars%2Fgravatar-140.png" width="24" />
              <a href="/JuhQ">JuhQ</a>
            </li>
            <li>
              <img height="24" src="https://secure.gravatar.com/avatar/3c5a0318513620a5d04916e7deee6737?s=140&amp;d=https://a248.e.akamai.net/assets.github.com%2Fimages%2Fgravatars%2Fgravatar-140.png" width="24" />
              <a href="/scottmac">scottmac</a>
            </li>
            <li>
              <img height="24" src="https://secure.gravatar.com/avatar/1ff6e4fc5862f200d8d17bb01bc4337a?s=140&amp;d=https://a248.e.akamai.net/assets.github.com%2Fimages%2Fgravatars%2Fgravatar-140.png" width="24" />
              <a href="/jerrycainjr">jerrycainjr</a>
            </li>
            <li>
              <img height="24" src="https://secure.gravatar.com/avatar/4564d3601f6230782300dff8499b2d5a?s=140&amp;d=https://a248.e.akamai.net/assets.github.com%2Fimages%2Fgravatars%2Fgravatar-140.png" width="24" />
              <a href="/sotarok">sotarok</a>
            </li>
            <li>
              <img height="24" src="https://secure.gravatar.com/avatar/6be8e584a0f454ac2dc7600bdeaca7b7?s=140&amp;d=https://a248.e.akamai.net/assets.github.com%2Fimages%2Fgravatars%2Fgravatar-140.png" width="24" />
              <a href="/brendo">brendo</a>
            </li>
            <li>
              <img height="24" src="https://secure.gravatar.com/avatar/a9cce97b982fca68c642b07237629917?s=140&amp;d=https://a248.e.akamai.net/assets.github.com%2Fimages%2Fgravatars%2Fgravatar-140.png" width="24" />
              <a href="/WizKid">WizKid</a>
            </li>
            <li>
              <img height="24" src="https://secure.gravatar.com/avatar/88e3bd41a474e9c1eb00499e013b334a?s=140&amp;d=https://a248.e.akamai.net/assets.github.com%2Fimages%2Fgravatars%2Fgravatar-140.png" width="24" />
              <a href="/KirilAngov">KirilAngov</a>
            </li>
          </ul>
        </div>
      </div>

    <div class="frames">
      <div class="frame frame-center" data-path="src/base_facebook.php/" data-permalink-url="/facebook/php-sdk/blob/6c82b3fdfb8efd27751de028d75fd3ab1f2c1ade/src/base_facebook.php" data-title="php-sdk/src/base_facebook.php at master · facebook/php-sdk · GitHub" data-type="blob">

        <div id="files" class="bubble">
          <div class="file">
            <div class="meta">
              <div class="info">
                <span class="icon"><b class="mini-icon text-file"></b></span>
                <span class="mode" title="File Mode">100644</span>
                  <span>1270 lines (1145 sloc)</span>
                <span>37.499 kb</span>
              </div>
              <ul class="button-group actions">
                  <li>
                    <a class="grouped-button file-edit-link minibutton bigger lighter js-rewrite-sha" href="/facebook/php-sdk/edit/6c82b3fdfb8efd27751de028d75fd3ab1f2c1ade/src/base_facebook.php" data-method="post" rel="nofollow"><span>Edit this file</span></a>
                  </li>

                <li>
                  <a href="/facebook/php-sdk/raw/master/src/base_facebook.php" class="minibutton btn-raw grouped-button bigger lighter" id="raw-url"><span><span class="icon"></span>Raw</span></a>
                </li>
                  <li>
                    <a href="/facebook/php-sdk/blame/master/src/base_facebook.php" class="minibutton btn-blame grouped-button bigger lighter"><span><span class="icon"></span>Blame</span></a>
                  </li>
                <li>
                  <a href="/facebook/php-sdk/commits/master/src/base_facebook.php" class="minibutton btn-history grouped-button bigger lighter" rel="nofollow"><span><span class="icon"></span>History</span></a>
                </li>
              </ul>
            </div>
              <div class="data type-php">
      <table cellpadding="0" cellspacing="0" class="lines">
        <tr>
          <td>
            <pre class="line_numbers"><span id="L1" rel="#L1">1</span>
<span id="L2" rel="#L2">2</span>
<span id="L3" rel="#L3">3</span>
<span id="L4" rel="#L4">4</span>
<span id="L5" rel="#L5">5</span>
<span id="L6" rel="#L6">6</span>
<span id="L7" rel="#L7">7</span>
<span id="L8" rel="#L8">8</span>
<span id="L9" rel="#L9">9</span>
<span id="L10" rel="#L10">10</span>
<span id="L11" rel="#L11">11</span>
<span id="L12" rel="#L12">12</span>
<span id="L13" rel="#L13">13</span>
<span id="L14" rel="#L14">14</span>
<span id="L15" rel="#L15">15</span>
<span id="L16" rel="#L16">16</span>
<span id="L17" rel="#L17">17</span>
<span id="L18" rel="#L18">18</span>
<span id="L19" rel="#L19">19</span>
<span id="L20" rel="#L20">20</span>
<span id="L21" rel="#L21">21</span>
<span id="L22" rel="#L22">22</span>
<span id="L23" rel="#L23">23</span>
<span id="L24" rel="#L24">24</span>
<span id="L25" rel="#L25">25</span>
<span id="L26" rel="#L26">26</span>
<span id="L27" rel="#L27">27</span>
<span id="L28" rel="#L28">28</span>
<span id="L29" rel="#L29">29</span>
<span id="L30" rel="#L30">30</span>
<span id="L31" rel="#L31">31</span>
<span id="L32" rel="#L32">32</span>
<span id="L33" rel="#L33">33</span>
<span id="L34" rel="#L34">34</span>
<span id="L35" rel="#L35">35</span>
<span id="L36" rel="#L36">36</span>
<span id="L37" rel="#L37">37</span>
<span id="L38" rel="#L38">38</span>
<span id="L39" rel="#L39">39</span>
<span id="L40" rel="#L40">40</span>
<span id="L41" rel="#L41">41</span>
<span id="L42" rel="#L42">42</span>
<span id="L43" rel="#L43">43</span>
<span id="L44" rel="#L44">44</span>
<span id="L45" rel="#L45">45</span>
<span id="L46" rel="#L46">46</span>
<span id="L47" rel="#L47">47</span>
<span id="L48" rel="#L48">48</span>
<span id="L49" rel="#L49">49</span>
<span id="L50" rel="#L50">50</span>
<span id="L51" rel="#L51">51</span>
<span id="L52" rel="#L52">52</span>
<span id="L53" rel="#L53">53</span>
<span id="L54" rel="#L54">54</span>
<span id="L55" rel="#L55">55</span>
<span id="L56" rel="#L56">56</span>
<span id="L57" rel="#L57">57</span>
<span id="L58" rel="#L58">58</span>
<span id="L59" rel="#L59">59</span>
<span id="L60" rel="#L60">60</span>
<span id="L61" rel="#L61">61</span>
<span id="L62" rel="#L62">62</span>
<span id="L63" rel="#L63">63</span>
<span id="L64" rel="#L64">64</span>
<span id="L65" rel="#L65">65</span>
<span id="L66" rel="#L66">66</span>
<span id="L67" rel="#L67">67</span>
<span id="L68" rel="#L68">68</span>
<span id="L69" rel="#L69">69</span>
<span id="L70" rel="#L70">70</span>
<span id="L71" rel="#L71">71</span>
<span id="L72" rel="#L72">72</span>
<span id="L73" rel="#L73">73</span>
<span id="L74" rel="#L74">74</span>
<span id="L75" rel="#L75">75</span>
<span id="L76" rel="#L76">76</span>
<span id="L77" rel="#L77">77</span>
<span id="L78" rel="#L78">78</span>
<span id="L79" rel="#L79">79</span>
<span id="L80" rel="#L80">80</span>
<span id="L81" rel="#L81">81</span>
<span id="L82" rel="#L82">82</span>
<span id="L83" rel="#L83">83</span>
<span id="L84" rel="#L84">84</span>
<span id="L85" rel="#L85">85</span>
<span id="L86" rel="#L86">86</span>
<span id="L87" rel="#L87">87</span>
<span id="L88" rel="#L88">88</span>
<span id="L89" rel="#L89">89</span>
<span id="L90" rel="#L90">90</span>
<span id="L91" rel="#L91">91</span>
<span id="L92" rel="#L92">92</span>
<span id="L93" rel="#L93">93</span>
<span id="L94" rel="#L94">94</span>
<span id="L95" rel="#L95">95</span>
<span id="L96" rel="#L96">96</span>
<span id="L97" rel="#L97">97</span>
<span id="L98" rel="#L98">98</span>
<span id="L99" rel="#L99">99</span>
<span id="L100" rel="#L100">100</span>
<span id="L101" rel="#L101">101</span>
<span id="L102" rel="#L102">102</span>
<span id="L103" rel="#L103">103</span>
<span id="L104" rel="#L104">104</span>
<span id="L105" rel="#L105">105</span>
<span id="L106" rel="#L106">106</span>
<span id="L107" rel="#L107">107</span>
<span id="L108" rel="#L108">108</span>
<span id="L109" rel="#L109">109</span>
<span id="L110" rel="#L110">110</span>
<span id="L111" rel="#L111">111</span>
<span id="L112" rel="#L112">112</span>
<span id="L113" rel="#L113">113</span>
<span id="L114" rel="#L114">114</span>
<span id="L115" rel="#L115">115</span>
<span id="L116" rel="#L116">116</span>
<span id="L117" rel="#L117">117</span>
<span id="L118" rel="#L118">118</span>
<span id="L119" rel="#L119">119</span>
<span id="L120" rel="#L120">120</span>
<span id="L121" rel="#L121">121</span>
<span id="L122" rel="#L122">122</span>
<span id="L123" rel="#L123">123</span>
<span id="L124" rel="#L124">124</span>
<span id="L125" rel="#L125">125</span>
<span id="L126" rel="#L126">126</span>
<span id="L127" rel="#L127">127</span>
<span id="L128" rel="#L128">128</span>
<span id="L129" rel="#L129">129</span>
<span id="L130" rel="#L130">130</span>
<span id="L131" rel="#L131">131</span>
<span id="L132" rel="#L132">132</span>
<span id="L133" rel="#L133">133</span>
<span id="L134" rel="#L134">134</span>
<span id="L135" rel="#L135">135</span>
<span id="L136" rel="#L136">136</span>
<span id="L137" rel="#L137">137</span>
<span id="L138" rel="#L138">138</span>
<span id="L139" rel="#L139">139</span>
<span id="L140" rel="#L140">140</span>
<span id="L141" rel="#L141">141</span>
<span id="L142" rel="#L142">142</span>
<span id="L143" rel="#L143">143</span>
<span id="L144" rel="#L144">144</span>
<span id="L145" rel="#L145">145</span>
<span id="L146" rel="#L146">146</span>
<span id="L147" rel="#L147">147</span>
<span id="L148" rel="#L148">148</span>
<span id="L149" rel="#L149">149</span>
<span id="L150" rel="#L150">150</span>
<span id="L151" rel="#L151">151</span>
<span id="L152" rel="#L152">152</span>
<span id="L153" rel="#L153">153</span>
<span id="L154" rel="#L154">154</span>
<span id="L155" rel="#L155">155</span>
<span id="L156" rel="#L156">156</span>
<span id="L157" rel="#L157">157</span>
<span id="L158" rel="#L158">158</span>
<span id="L159" rel="#L159">159</span>
<span id="L160" rel="#L160">160</span>
<span id="L161" rel="#L161">161</span>
<span id="L162" rel="#L162">162</span>
<span id="L163" rel="#L163">163</span>
<span id="L164" rel="#L164">164</span>
<span id="L165" rel="#L165">165</span>
<span id="L166" rel="#L166">166</span>
<span id="L167" rel="#L167">167</span>
<span id="L168" rel="#L168">168</span>
<span id="L169" rel="#L169">169</span>
<span id="L170" rel="#L170">170</span>
<span id="L171" rel="#L171">171</span>
<span id="L172" rel="#L172">172</span>
<span id="L173" rel="#L173">173</span>
<span id="L174" rel="#L174">174</span>
<span id="L175" rel="#L175">175</span>
<span id="L176" rel="#L176">176</span>
<span id="L177" rel="#L177">177</span>
<span id="L178" rel="#L178">178</span>
<span id="L179" rel="#L179">179</span>
<span id="L180" rel="#L180">180</span>
<span id="L181" rel="#L181">181</span>
<span id="L182" rel="#L182">182</span>
<span id="L183" rel="#L183">183</span>
<span id="L184" rel="#L184">184</span>
<span id="L185" rel="#L185">185</span>
<span id="L186" rel="#L186">186</span>
<span id="L187" rel="#L187">187</span>
<span id="L188" rel="#L188">188</span>
<span id="L189" rel="#L189">189</span>
<span id="L190" rel="#L190">190</span>
<span id="L191" rel="#L191">191</span>
<span id="L192" rel="#L192">192</span>
<span id="L193" rel="#L193">193</span>
<span id="L194" rel="#L194">194</span>
<span id="L195" rel="#L195">195</span>
<span id="L196" rel="#L196">196</span>
<span id="L197" rel="#L197">197</span>
<span id="L198" rel="#L198">198</span>
<span id="L199" rel="#L199">199</span>
<span id="L200" rel="#L200">200</span>
<span id="L201" rel="#L201">201</span>
<span id="L202" rel="#L202">202</span>
<span id="L203" rel="#L203">203</span>
<span id="L204" rel="#L204">204</span>
<span id="L205" rel="#L205">205</span>
<span id="L206" rel="#L206">206</span>
<span id="L207" rel="#L207">207</span>
<span id="L208" rel="#L208">208</span>
<span id="L209" rel="#L209">209</span>
<span id="L210" rel="#L210">210</span>
<span id="L211" rel="#L211">211</span>
<span id="L212" rel="#L212">212</span>
<span id="L213" rel="#L213">213</span>
<span id="L214" rel="#L214">214</span>
<span id="L215" rel="#L215">215</span>
<span id="L216" rel="#L216">216</span>
<span id="L217" rel="#L217">217</span>
<span id="L218" rel="#L218">218</span>
<span id="L219" rel="#L219">219</span>
<span id="L220" rel="#L220">220</span>
<span id="L221" rel="#L221">221</span>
<span id="L222" rel="#L222">222</span>
<span id="L223" rel="#L223">223</span>
<span id="L224" rel="#L224">224</span>
<span id="L225" rel="#L225">225</span>
<span id="L226" rel="#L226">226</span>
<span id="L227" rel="#L227">227</span>
<span id="L228" rel="#L228">228</span>
<span id="L229" rel="#L229">229</span>
<span id="L230" rel="#L230">230</span>
<span id="L231" rel="#L231">231</span>
<span id="L232" rel="#L232">232</span>
<span id="L233" rel="#L233">233</span>
<span id="L234" rel="#L234">234</span>
<span id="L235" rel="#L235">235</span>
<span id="L236" rel="#L236">236</span>
<span id="L237" rel="#L237">237</span>
<span id="L238" rel="#L238">238</span>
<span id="L239" rel="#L239">239</span>
<span id="L240" rel="#L240">240</span>
<span id="L241" rel="#L241">241</span>
<span id="L242" rel="#L242">242</span>
<span id="L243" rel="#L243">243</span>
<span id="L244" rel="#L244">244</span>
<span id="L245" rel="#L245">245</span>
<span id="L246" rel="#L246">246</span>
<span id="L247" rel="#L247">247</span>
<span id="L248" rel="#L248">248</span>
<span id="L249" rel="#L249">249</span>
<span id="L250" rel="#L250">250</span>
<span id="L251" rel="#L251">251</span>
<span id="L252" rel="#L252">252</span>
<span id="L253" rel="#L253">253</span>
<span id="L254" rel="#L254">254</span>
<span id="L255" rel="#L255">255</span>
<span id="L256" rel="#L256">256</span>
<span id="L257" rel="#L257">257</span>
<span id="L258" rel="#L258">258</span>
<span id="L259" rel="#L259">259</span>
<span id="L260" rel="#L260">260</span>
<span id="L261" rel="#L261">261</span>
<span id="L262" rel="#L262">262</span>
<span id="L263" rel="#L263">263</span>
<span id="L264" rel="#L264">264</span>
<span id="L265" rel="#L265">265</span>
<span id="L266" rel="#L266">266</span>
<span id="L267" rel="#L267">267</span>
<span id="L268" rel="#L268">268</span>
<span id="L269" rel="#L269">269</span>
<span id="L270" rel="#L270">270</span>
<span id="L271" rel="#L271">271</span>
<span id="L272" rel="#L272">272</span>
<span id="L273" rel="#L273">273</span>
<span id="L274" rel="#L274">274</span>
<span id="L275" rel="#L275">275</span>
<span id="L276" rel="#L276">276</span>
<span id="L277" rel="#L277">277</span>
<span id="L278" rel="#L278">278</span>
<span id="L279" rel="#L279">279</span>
<span id="L280" rel="#L280">280</span>
<span id="L281" rel="#L281">281</span>
<span id="L282" rel="#L282">282</span>
<span id="L283" rel="#L283">283</span>
<span id="L284" rel="#L284">284</span>
<span id="L285" rel="#L285">285</span>
<span id="L286" rel="#L286">286</span>
<span id="L287" rel="#L287">287</span>
<span id="L288" rel="#L288">288</span>
<span id="L289" rel="#L289">289</span>
<span id="L290" rel="#L290">290</span>
<span id="L291" rel="#L291">291</span>
<span id="L292" rel="#L292">292</span>
<span id="L293" rel="#L293">293</span>
<span id="L294" rel="#L294">294</span>
<span id="L295" rel="#L295">295</span>
<span id="L296" rel="#L296">296</span>
<span id="L297" rel="#L297">297</span>
<span id="L298" rel="#L298">298</span>
<span id="L299" rel="#L299">299</span>
<span id="L300" rel="#L300">300</span>
<span id="L301" rel="#L301">301</span>
<span id="L302" rel="#L302">302</span>
<span id="L303" rel="#L303">303</span>
<span id="L304" rel="#L304">304</span>
<span id="L305" rel="#L305">305</span>
<span id="L306" rel="#L306">306</span>
<span id="L307" rel="#L307">307</span>
<span id="L308" rel="#L308">308</span>
<span id="L309" rel="#L309">309</span>
<span id="L310" rel="#L310">310</span>
<span id="L311" rel="#L311">311</span>
<span id="L312" rel="#L312">312</span>
<span id="L313" rel="#L313">313</span>
<span id="L314" rel="#L314">314</span>
<span id="L315" rel="#L315">315</span>
<span id="L316" rel="#L316">316</span>
<span id="L317" rel="#L317">317</span>
<span id="L318" rel="#L318">318</span>
<span id="L319" rel="#L319">319</span>
<span id="L320" rel="#L320">320</span>
<span id="L321" rel="#L321">321</span>
<span id="L322" rel="#L322">322</span>
<span id="L323" rel="#L323">323</span>
<span id="L324" rel="#L324">324</span>
<span id="L325" rel="#L325">325</span>
<span id="L326" rel="#L326">326</span>
<span id="L327" rel="#L327">327</span>
<span id="L328" rel="#L328">328</span>
<span id="L329" rel="#L329">329</span>
<span id="L330" rel="#L330">330</span>
<span id="L331" rel="#L331">331</span>
<span id="L332" rel="#L332">332</span>
<span id="L333" rel="#L333">333</span>
<span id="L334" rel="#L334">334</span>
<span id="L335" rel="#L335">335</span>
<span id="L336" rel="#L336">336</span>
<span id="L337" rel="#L337">337</span>
<span id="L338" rel="#L338">338</span>
<span id="L339" rel="#L339">339</span>
<span id="L340" rel="#L340">340</span>
<span id="L341" rel="#L341">341</span>
<span id="L342" rel="#L342">342</span>
<span id="L343" rel="#L343">343</span>
<span id="L344" rel="#L344">344</span>
<span id="L345" rel="#L345">345</span>
<span id="L346" rel="#L346">346</span>
<span id="L347" rel="#L347">347</span>
<span id="L348" rel="#L348">348</span>
<span id="L349" rel="#L349">349</span>
<span id="L350" rel="#L350">350</span>
<span id="L351" rel="#L351">351</span>
<span id="L352" rel="#L352">352</span>
<span id="L353" rel="#L353">353</span>
<span id="L354" rel="#L354">354</span>
<span id="L355" rel="#L355">355</span>
<span id="L356" rel="#L356">356</span>
<span id="L357" rel="#L357">357</span>
<span id="L358" rel="#L358">358</span>
<span id="L359" rel="#L359">359</span>
<span id="L360" rel="#L360">360</span>
<span id="L361" rel="#L361">361</span>
<span id="L362" rel="#L362">362</span>
<span id="L363" rel="#L363">363</span>
<span id="L364" rel="#L364">364</span>
<span id="L365" rel="#L365">365</span>
<span id="L366" rel="#L366">366</span>
<span id="L367" rel="#L367">367</span>
<span id="L368" rel="#L368">368</span>
<span id="L369" rel="#L369">369</span>
<span id="L370" rel="#L370">370</span>
<span id="L371" rel="#L371">371</span>
<span id="L372" rel="#L372">372</span>
<span id="L373" rel="#L373">373</span>
<span id="L374" rel="#L374">374</span>
<span id="L375" rel="#L375">375</span>
<span id="L376" rel="#L376">376</span>
<span id="L377" rel="#L377">377</span>
<span id="L378" rel="#L378">378</span>
<span id="L379" rel="#L379">379</span>
<span id="L380" rel="#L380">380</span>
<span id="L381" rel="#L381">381</span>
<span id="L382" rel="#L382">382</span>
<span id="L383" rel="#L383">383</span>
<span id="L384" rel="#L384">384</span>
<span id="L385" rel="#L385">385</span>
<span id="L386" rel="#L386">386</span>
<span id="L387" rel="#L387">387</span>
<span id="L388" rel="#L388">388</span>
<span id="L389" rel="#L389">389</span>
<span id="L390" rel="#L390">390</span>
<span id="L391" rel="#L391">391</span>
<span id="L392" rel="#L392">392</span>
<span id="L393" rel="#L393">393</span>
<span id="L394" rel="#L394">394</span>
<span id="L395" rel="#L395">395</span>
<span id="L396" rel="#L396">396</span>
<span id="L397" rel="#L397">397</span>
<span id="L398" rel="#L398">398</span>
<span id="L399" rel="#L399">399</span>
<span id="L400" rel="#L400">400</span>
<span id="L401" rel="#L401">401</span>
<span id="L402" rel="#L402">402</span>
<span id="L403" rel="#L403">403</span>
<span id="L404" rel="#L404">404</span>
<span id="L405" rel="#L405">405</span>
<span id="L406" rel="#L406">406</span>
<span id="L407" rel="#L407">407</span>
<span id="L408" rel="#L408">408</span>
<span id="L409" rel="#L409">409</span>
<span id="L410" rel="#L410">410</span>
<span id="L411" rel="#L411">411</span>
<span id="L412" rel="#L412">412</span>
<span id="L413" rel="#L413">413</span>
<span id="L414" rel="#L414">414</span>
<span id="L415" rel="#L415">415</span>
<span id="L416" rel="#L416">416</span>
<span id="L417" rel="#L417">417</span>
<span id="L418" rel="#L418">418</span>
<span id="L419" rel="#L419">419</span>
<span id="L420" rel="#L420">420</span>
<span id="L421" rel="#L421">421</span>
<span id="L422" rel="#L422">422</span>
<span id="L423" rel="#L423">423</span>
<span id="L424" rel="#L424">424</span>
<span id="L425" rel="#L425">425</span>
<span id="L426" rel="#L426">426</span>
<span id="L427" rel="#L427">427</span>
<span id="L428" rel="#L428">428</span>
<span id="L429" rel="#L429">429</span>
<span id="L430" rel="#L430">430</span>
<span id="L431" rel="#L431">431</span>
<span id="L432" rel="#L432">432</span>
<span id="L433" rel="#L433">433</span>
<span id="L434" rel="#L434">434</span>
<span id="L435" rel="#L435">435</span>
<span id="L436" rel="#L436">436</span>
<span id="L437" rel="#L437">437</span>
<span id="L438" rel="#L438">438</span>
<span id="L439" rel="#L439">439</span>
<span id="L440" rel="#L440">440</span>
<span id="L441" rel="#L441">441</span>
<span id="L442" rel="#L442">442</span>
<span id="L443" rel="#L443">443</span>
<span id="L444" rel="#L444">444</span>
<span id="L445" rel="#L445">445</span>
<span id="L446" rel="#L446">446</span>
<span id="L447" rel="#L447">447</span>
<span id="L448" rel="#L448">448</span>
<span id="L449" rel="#L449">449</span>
<span id="L450" rel="#L450">450</span>
<span id="L451" rel="#L451">451</span>
<span id="L452" rel="#L452">452</span>
<span id="L453" rel="#L453">453</span>
<span id="L454" rel="#L454">454</span>
<span id="L455" rel="#L455">455</span>
<span id="L456" rel="#L456">456</span>
<span id="L457" rel="#L457">457</span>
<span id="L458" rel="#L458">458</span>
<span id="L459" rel="#L459">459</span>
<span id="L460" rel="#L460">460</span>
<span id="L461" rel="#L461">461</span>
<span id="L462" rel="#L462">462</span>
<span id="L463" rel="#L463">463</span>
<span id="L464" rel="#L464">464</span>
<span id="L465" rel="#L465">465</span>
<span id="L466" rel="#L466">466</span>
<span id="L467" rel="#L467">467</span>
<span id="L468" rel="#L468">468</span>
<span id="L469" rel="#L469">469</span>
<span id="L470" rel="#L470">470</span>
<span id="L471" rel="#L471">471</span>
<span id="L472" rel="#L472">472</span>
<span id="L473" rel="#L473">473</span>
<span id="L474" rel="#L474">474</span>
<span id="L475" rel="#L475">475</span>
<span id="L476" rel="#L476">476</span>
<span id="L477" rel="#L477">477</span>
<span id="L478" rel="#L478">478</span>
<span id="L479" rel="#L479">479</span>
<span id="L480" rel="#L480">480</span>
<span id="L481" rel="#L481">481</span>
<span id="L482" rel="#L482">482</span>
<span id="L483" rel="#L483">483</span>
<span id="L484" rel="#L484">484</span>
<span id="L485" rel="#L485">485</span>
<span id="L486" rel="#L486">486</span>
<span id="L487" rel="#L487">487</span>
<span id="L488" rel="#L488">488</span>
<span id="L489" rel="#L489">489</span>
<span id="L490" rel="#L490">490</span>
<span id="L491" rel="#L491">491</span>
<span id="L492" rel="#L492">492</span>
<span id="L493" rel="#L493">493</span>
<span id="L494" rel="#L494">494</span>
<span id="L495" rel="#L495">495</span>
<span id="L496" rel="#L496">496</span>
<span id="L497" rel="#L497">497</span>
<span id="L498" rel="#L498">498</span>
<span id="L499" rel="#L499">499</span>
<span id="L500" rel="#L500">500</span>
<span id="L501" rel="#L501">501</span>
<span id="L502" rel="#L502">502</span>
<span id="L503" rel="#L503">503</span>
<span id="L504" rel="#L504">504</span>
<span id="L505" rel="#L505">505</span>
<span id="L506" rel="#L506">506</span>
<span id="L507" rel="#L507">507</span>
<span id="L508" rel="#L508">508</span>
<span id="L509" rel="#L509">509</span>
<span id="L510" rel="#L510">510</span>
<span id="L511" rel="#L511">511</span>
<span id="L512" rel="#L512">512</span>
<span id="L513" rel="#L513">513</span>
<span id="L514" rel="#L514">514</span>
<span id="L515" rel="#L515">515</span>
<span id="L516" rel="#L516">516</span>
<span id="L517" rel="#L517">517</span>
<span id="L518" rel="#L518">518</span>
<span id="L519" rel="#L519">519</span>
<span id="L520" rel="#L520">520</span>
<span id="L521" rel="#L521">521</span>
<span id="L522" rel="#L522">522</span>
<span id="L523" rel="#L523">523</span>
<span id="L524" rel="#L524">524</span>
<span id="L525" rel="#L525">525</span>
<span id="L526" rel="#L526">526</span>
<span id="L527" rel="#L527">527</span>
<span id="L528" rel="#L528">528</span>
<span id="L529" rel="#L529">529</span>
<span id="L530" rel="#L530">530</span>
<span id="L531" rel="#L531">531</span>
<span id="L532" rel="#L532">532</span>
<span id="L533" rel="#L533">533</span>
<span id="L534" rel="#L534">534</span>
<span id="L535" rel="#L535">535</span>
<span id="L536" rel="#L536">536</span>
<span id="L537" rel="#L537">537</span>
<span id="L538" rel="#L538">538</span>
<span id="L539" rel="#L539">539</span>
<span id="L540" rel="#L540">540</span>
<span id="L541" rel="#L541">541</span>
<span id="L542" rel="#L542">542</span>
<span id="L543" rel="#L543">543</span>
<span id="L544" rel="#L544">544</span>
<span id="L545" rel="#L545">545</span>
<span id="L546" rel="#L546">546</span>
<span id="L547" rel="#L547">547</span>
<span id="L548" rel="#L548">548</span>
<span id="L549" rel="#L549">549</span>
<span id="L550" rel="#L550">550</span>
<span id="L551" rel="#L551">551</span>
<span id="L552" rel="#L552">552</span>
<span id="L553" rel="#L553">553</span>
<span id="L554" rel="#L554">554</span>
<span id="L555" rel="#L555">555</span>
<span id="L556" rel="#L556">556</span>
<span id="L557" rel="#L557">557</span>
<span id="L558" rel="#L558">558</span>
<span id="L559" rel="#L559">559</span>
<span id="L560" rel="#L560">560</span>
<span id="L561" rel="#L561">561</span>
<span id="L562" rel="#L562">562</span>
<span id="L563" rel="#L563">563</span>
<span id="L564" rel="#L564">564</span>
<span id="L565" rel="#L565">565</span>
<span id="L566" rel="#L566">566</span>
<span id="L567" rel="#L567">567</span>
<span id="L568" rel="#L568">568</span>
<span id="L569" rel="#L569">569</span>
<span id="L570" rel="#L570">570</span>
<span id="L571" rel="#L571">571</span>
<span id="L572" rel="#L572">572</span>
<span id="L573" rel="#L573">573</span>
<span id="L574" rel="#L574">574</span>
<span id="L575" rel="#L575">575</span>
<span id="L576" rel="#L576">576</span>
<span id="L577" rel="#L577">577</span>
<span id="L578" rel="#L578">578</span>
<span id="L579" rel="#L579">579</span>
<span id="L580" rel="#L580">580</span>
<span id="L581" rel="#L581">581</span>
<span id="L582" rel="#L582">582</span>
<span id="L583" rel="#L583">583</span>
<span id="L584" rel="#L584">584</span>
<span id="L585" rel="#L585">585</span>
<span id="L586" rel="#L586">586</span>
<span id="L587" rel="#L587">587</span>
<span id="L588" rel="#L588">588</span>
<span id="L589" rel="#L589">589</span>
<span id="L590" rel="#L590">590</span>
<span id="L591" rel="#L591">591</span>
<span id="L592" rel="#L592">592</span>
<span id="L593" rel="#L593">593</span>
<span id="L594" rel="#L594">594</span>
<span id="L595" rel="#L595">595</span>
<span id="L596" rel="#L596">596</span>
<span id="L597" rel="#L597">597</span>
<span id="L598" rel="#L598">598</span>
<span id="L599" rel="#L599">599</span>
<span id="L600" rel="#L600">600</span>
<span id="L601" rel="#L601">601</span>
<span id="L602" rel="#L602">602</span>
<span id="L603" rel="#L603">603</span>
<span id="L604" rel="#L604">604</span>
<span id="L605" rel="#L605">605</span>
<span id="L606" rel="#L606">606</span>
<span id="L607" rel="#L607">607</span>
<span id="L608" rel="#L608">608</span>
<span id="L609" rel="#L609">609</span>
<span id="L610" rel="#L610">610</span>
<span id="L611" rel="#L611">611</span>
<span id="L612" rel="#L612">612</span>
<span id="L613" rel="#L613">613</span>
<span id="L614" rel="#L614">614</span>
<span id="L615" rel="#L615">615</span>
<span id="L616" rel="#L616">616</span>
<span id="L617" rel="#L617">617</span>
<span id="L618" rel="#L618">618</span>
<span id="L619" rel="#L619">619</span>
<span id="L620" rel="#L620">620</span>
<span id="L621" rel="#L621">621</span>
<span id="L622" rel="#L622">622</span>
<span id="L623" rel="#L623">623</span>
<span id="L624" rel="#L624">624</span>
<span id="L625" rel="#L625">625</span>
<span id="L626" rel="#L626">626</span>
<span id="L627" rel="#L627">627</span>
<span id="L628" rel="#L628">628</span>
<span id="L629" rel="#L629">629</span>
<span id="L630" rel="#L630">630</span>
<span id="L631" rel="#L631">631</span>
<span id="L632" rel="#L632">632</span>
<span id="L633" rel="#L633">633</span>
<span id="L634" rel="#L634">634</span>
<span id="L635" rel="#L635">635</span>
<span id="L636" rel="#L636">636</span>
<span id="L637" rel="#L637">637</span>
<span id="L638" rel="#L638">638</span>
<span id="L639" rel="#L639">639</span>
<span id="L640" rel="#L640">640</span>
<span id="L641" rel="#L641">641</span>
<span id="L642" rel="#L642">642</span>
<span id="L643" rel="#L643">643</span>
<span id="L644" rel="#L644">644</span>
<span id="L645" rel="#L645">645</span>
<span id="L646" rel="#L646">646</span>
<span id="L647" rel="#L647">647</span>
<span id="L648" rel="#L648">648</span>
<span id="L649" rel="#L649">649</span>
<span id="L650" rel="#L650">650</span>
<span id="L651" rel="#L651">651</span>
<span id="L652" rel="#L652">652</span>
<span id="L653" rel="#L653">653</span>
<span id="L654" rel="#L654">654</span>
<span id="L655" rel="#L655">655</span>
<span id="L656" rel="#L656">656</span>
<span id="L657" rel="#L657">657</span>
<span id="L658" rel="#L658">658</span>
<span id="L659" rel="#L659">659</span>
<span id="L660" rel="#L660">660</span>
<span id="L661" rel="#L661">661</span>
<span id="L662" rel="#L662">662</span>
<span id="L663" rel="#L663">663</span>
<span id="L664" rel="#L664">664</span>
<span id="L665" rel="#L665">665</span>
<span id="L666" rel="#L666">666</span>
<span id="L667" rel="#L667">667</span>
<span id="L668" rel="#L668">668</span>
<span id="L669" rel="#L669">669</span>
<span id="L670" rel="#L670">670</span>
<span id="L671" rel="#L671">671</span>
<span id="L672" rel="#L672">672</span>
<span id="L673" rel="#L673">673</span>
<span id="L674" rel="#L674">674</span>
<span id="L675" rel="#L675">675</span>
<span id="L676" rel="#L676">676</span>
<span id="L677" rel="#L677">677</span>
<span id="L678" rel="#L678">678</span>
<span id="L679" rel="#L679">679</span>
<span id="L680" rel="#L680">680</span>
<span id="L681" rel="#L681">681</span>
<span id="L682" rel="#L682">682</span>
<span id="L683" rel="#L683">683</span>
<span id="L684" rel="#L684">684</span>
<span id="L685" rel="#L685">685</span>
<span id="L686" rel="#L686">686</span>
<span id="L687" rel="#L687">687</span>
<span id="L688" rel="#L688">688</span>
<span id="L689" rel="#L689">689</span>
<span id="L690" rel="#L690">690</span>
<span id="L691" rel="#L691">691</span>
<span id="L692" rel="#L692">692</span>
<span id="L693" rel="#L693">693</span>
<span id="L694" rel="#L694">694</span>
<span id="L695" rel="#L695">695</span>
<span id="L696" rel="#L696">696</span>
<span id="L697" rel="#L697">697</span>
<span id="L698" rel="#L698">698</span>
<span id="L699" rel="#L699">699</span>
<span id="L700" rel="#L700">700</span>
<span id="L701" rel="#L701">701</span>
<span id="L702" rel="#L702">702</span>
<span id="L703" rel="#L703">703</span>
<span id="L704" rel="#L704">704</span>
<span id="L705" rel="#L705">705</span>
<span id="L706" rel="#L706">706</span>
<span id="L707" rel="#L707">707</span>
<span id="L708" rel="#L708">708</span>
<span id="L709" rel="#L709">709</span>
<span id="L710" rel="#L710">710</span>
<span id="L711" rel="#L711">711</span>
<span id="L712" rel="#L712">712</span>
<span id="L713" rel="#L713">713</span>
<span id="L714" rel="#L714">714</span>
<span id="L715" rel="#L715">715</span>
<span id="L716" rel="#L716">716</span>
<span id="L717" rel="#L717">717</span>
<span id="L718" rel="#L718">718</span>
<span id="L719" rel="#L719">719</span>
<span id="L720" rel="#L720">720</span>
<span id="L721" rel="#L721">721</span>
<span id="L722" rel="#L722">722</span>
<span id="L723" rel="#L723">723</span>
<span id="L724" rel="#L724">724</span>
<span id="L725" rel="#L725">725</span>
<span id="L726" rel="#L726">726</span>
<span id="L727" rel="#L727">727</span>
<span id="L728" rel="#L728">728</span>
<span id="L729" rel="#L729">729</span>
<span id="L730" rel="#L730">730</span>
<span id="L731" rel="#L731">731</span>
<span id="L732" rel="#L732">732</span>
<span id="L733" rel="#L733">733</span>
<span id="L734" rel="#L734">734</span>
<span id="L735" rel="#L735">735</span>
<span id="L736" rel="#L736">736</span>
<span id="L737" rel="#L737">737</span>
<span id="L738" rel="#L738">738</span>
<span id="L739" rel="#L739">739</span>
<span id="L740" rel="#L740">740</span>
<span id="L741" rel="#L741">741</span>
<span id="L742" rel="#L742">742</span>
<span id="L743" rel="#L743">743</span>
<span id="L744" rel="#L744">744</span>
<span id="L745" rel="#L745">745</span>
<span id="L746" rel="#L746">746</span>
<span id="L747" rel="#L747">747</span>
<span id="L748" rel="#L748">748</span>
<span id="L749" rel="#L749">749</span>
<span id="L750" rel="#L750">750</span>
<span id="L751" rel="#L751">751</span>
<span id="L752" rel="#L752">752</span>
<span id="L753" rel="#L753">753</span>
<span id="L754" rel="#L754">754</span>
<span id="L755" rel="#L755">755</span>
<span id="L756" rel="#L756">756</span>
<span id="L757" rel="#L757">757</span>
<span id="L758" rel="#L758">758</span>
<span id="L759" rel="#L759">759</span>
<span id="L760" rel="#L760">760</span>
<span id="L761" rel="#L761">761</span>
<span id="L762" rel="#L762">762</span>
<span id="L763" rel="#L763">763</span>
<span id="L764" rel="#L764">764</span>
<span id="L765" rel="#L765">765</span>
<span id="L766" rel="#L766">766</span>
<span id="L767" rel="#L767">767</span>
<span id="L768" rel="#L768">768</span>
<span id="L769" rel="#L769">769</span>
<span id="L770" rel="#L770">770</span>
<span id="L771" rel="#L771">771</span>
<span id="L772" rel="#L772">772</span>
<span id="L773" rel="#L773">773</span>
<span id="L774" rel="#L774">774</span>
<span id="L775" rel="#L775">775</span>
<span id="L776" rel="#L776">776</span>
<span id="L777" rel="#L777">777</span>
<span id="L778" rel="#L778">778</span>
<span id="L779" rel="#L779">779</span>
<span id="L780" rel="#L780">780</span>
<span id="L781" rel="#L781">781</span>
<span id="L782" rel="#L782">782</span>
<span id="L783" rel="#L783">783</span>
<span id="L784" rel="#L784">784</span>
<span id="L785" rel="#L785">785</span>
<span id="L786" rel="#L786">786</span>
<span id="L787" rel="#L787">787</span>
<span id="L788" rel="#L788">788</span>
<span id="L789" rel="#L789">789</span>
<span id="L790" rel="#L790">790</span>
<span id="L791" rel="#L791">791</span>
<span id="L792" rel="#L792">792</span>
<span id="L793" rel="#L793">793</span>
<span id="L794" rel="#L794">794</span>
<span id="L795" rel="#L795">795</span>
<span id="L796" rel="#L796">796</span>
<span id="L797" rel="#L797">797</span>
<span id="L798" rel="#L798">798</span>
<span id="L799" rel="#L799">799</span>
<span id="L800" rel="#L800">800</span>
<span id="L801" rel="#L801">801</span>
<span id="L802" rel="#L802">802</span>
<span id="L803" rel="#L803">803</span>
<span id="L804" rel="#L804">804</span>
<span id="L805" rel="#L805">805</span>
<span id="L806" rel="#L806">806</span>
<span id="L807" rel="#L807">807</span>
<span id="L808" rel="#L808">808</span>
<span id="L809" rel="#L809">809</span>
<span id="L810" rel="#L810">810</span>
<span id="L811" rel="#L811">811</span>
<span id="L812" rel="#L812">812</span>
<span id="L813" rel="#L813">813</span>
<span id="L814" rel="#L814">814</span>
<span id="L815" rel="#L815">815</span>
<span id="L816" rel="#L816">816</span>
<span id="L817" rel="#L817">817</span>
<span id="L818" rel="#L818">818</span>
<span id="L819" rel="#L819">819</span>
<span id="L820" rel="#L820">820</span>
<span id="L821" rel="#L821">821</span>
<span id="L822" rel="#L822">822</span>
<span id="L823" rel="#L823">823</span>
<span id="L824" rel="#L824">824</span>
<span id="L825" rel="#L825">825</span>
<span id="L826" rel="#L826">826</span>
<span id="L827" rel="#L827">827</span>
<span id="L828" rel="#L828">828</span>
<span id="L829" rel="#L829">829</span>
<span id="L830" rel="#L830">830</span>
<span id="L831" rel="#L831">831</span>
<span id="L832" rel="#L832">832</span>
<span id="L833" rel="#L833">833</span>
<span id="L834" rel="#L834">834</span>
<span id="L835" rel="#L835">835</span>
<span id="L836" rel="#L836">836</span>
<span id="L837" rel="#L837">837</span>
<span id="L838" rel="#L838">838</span>
<span id="L839" rel="#L839">839</span>
<span id="L840" rel="#L840">840</span>
<span id="L841" rel="#L841">841</span>
<span id="L842" rel="#L842">842</span>
<span id="L843" rel="#L843">843</span>
<span id="L844" rel="#L844">844</span>
<span id="L845" rel="#L845">845</span>
<span id="L846" rel="#L846">846</span>
<span id="L847" rel="#L847">847</span>
<span id="L848" rel="#L848">848</span>
<span id="L849" rel="#L849">849</span>
<span id="L850" rel="#L850">850</span>
<span id="L851" rel="#L851">851</span>
<span id="L852" rel="#L852">852</span>
<span id="L853" rel="#L853">853</span>
<span id="L854" rel="#L854">854</span>
<span id="L855" rel="#L855">855</span>
<span id="L856" rel="#L856">856</span>
<span id="L857" rel="#L857">857</span>
<span id="L858" rel="#L858">858</span>
<span id="L859" rel="#L859">859</span>
<span id="L860" rel="#L860">860</span>
<span id="L861" rel="#L861">861</span>
<span id="L862" rel="#L862">862</span>
<span id="L863" rel="#L863">863</span>
<span id="L864" rel="#L864">864</span>
<span id="L865" rel="#L865">865</span>
<span id="L866" rel="#L866">866</span>
<span id="L867" rel="#L867">867</span>
<span id="L868" rel="#L868">868</span>
<span id="L869" rel="#L869">869</span>
<span id="L870" rel="#L870">870</span>
<span id="L871" rel="#L871">871</span>
<span id="L872" rel="#L872">872</span>
<span id="L873" rel="#L873">873</span>
<span id="L874" rel="#L874">874</span>
<span id="L875" rel="#L875">875</span>
<span id="L876" rel="#L876">876</span>
<span id="L877" rel="#L877">877</span>
<span id="L878" rel="#L878">878</span>
<span id="L879" rel="#L879">879</span>
<span id="L880" rel="#L880">880</span>
<span id="L881" rel="#L881">881</span>
<span id="L882" rel="#L882">882</span>
<span id="L883" rel="#L883">883</span>
<span id="L884" rel="#L884">884</span>
<span id="L885" rel="#L885">885</span>
<span id="L886" rel="#L886">886</span>
<span id="L887" rel="#L887">887</span>
<span id="L888" rel="#L888">888</span>
<span id="L889" rel="#L889">889</span>
<span id="L890" rel="#L890">890</span>
<span id="L891" rel="#L891">891</span>
<span id="L892" rel="#L892">892</span>
<span id="L893" rel="#L893">893</span>
<span id="L894" rel="#L894">894</span>
<span id="L895" rel="#L895">895</span>
<span id="L896" rel="#L896">896</span>
<span id="L897" rel="#L897">897</span>
<span id="L898" rel="#L898">898</span>
<span id="L899" rel="#L899">899</span>
<span id="L900" rel="#L900">900</span>
<span id="L901" rel="#L901">901</span>
<span id="L902" rel="#L902">902</span>
<span id="L903" rel="#L903">903</span>
<span id="L904" rel="#L904">904</span>
<span id="L905" rel="#L905">905</span>
<span id="L906" rel="#L906">906</span>
<span id="L907" rel="#L907">907</span>
<span id="L908" rel="#L908">908</span>
<span id="L909" rel="#L909">909</span>
<span id="L910" rel="#L910">910</span>
<span id="L911" rel="#L911">911</span>
<span id="L912" rel="#L912">912</span>
<span id="L913" rel="#L913">913</span>
<span id="L914" rel="#L914">914</span>
<span id="L915" rel="#L915">915</span>
<span id="L916" rel="#L916">916</span>
<span id="L917" rel="#L917">917</span>
<span id="L918" rel="#L918">918</span>
<span id="L919" rel="#L919">919</span>
<span id="L920" rel="#L920">920</span>
<span id="L921" rel="#L921">921</span>
<span id="L922" rel="#L922">922</span>
<span id="L923" rel="#L923">923</span>
<span id="L924" rel="#L924">924</span>
<span id="L925" rel="#L925">925</span>
<span id="L926" rel="#L926">926</span>
<span id="L927" rel="#L927">927</span>
<span id="L928" rel="#L928">928</span>
<span id="L929" rel="#L929">929</span>
<span id="L930" rel="#L930">930</span>
<span id="L931" rel="#L931">931</span>
<span id="L932" rel="#L932">932</span>
<span id="L933" rel="#L933">933</span>
<span id="L934" rel="#L934">934</span>
<span id="L935" rel="#L935">935</span>
<span id="L936" rel="#L936">936</span>
<span id="L937" rel="#L937">937</span>
<span id="L938" rel="#L938">938</span>
<span id="L939" rel="#L939">939</span>
<span id="L940" rel="#L940">940</span>
<span id="L941" rel="#L941">941</span>
<span id="L942" rel="#L942">942</span>
<span id="L943" rel="#L943">943</span>
<span id="L944" rel="#L944">944</span>
<span id="L945" rel="#L945">945</span>
<span id="L946" rel="#L946">946</span>
<span id="L947" rel="#L947">947</span>
<span id="L948" rel="#L948">948</span>
<span id="L949" rel="#L949">949</span>
<span id="L950" rel="#L950">950</span>
<span id="L951" rel="#L951">951</span>
<span id="L952" rel="#L952">952</span>
<span id="L953" rel="#L953">953</span>
<span id="L954" rel="#L954">954</span>
<span id="L955" rel="#L955">955</span>
<span id="L956" rel="#L956">956</span>
<span id="L957" rel="#L957">957</span>
<span id="L958" rel="#L958">958</span>
<span id="L959" rel="#L959">959</span>
<span id="L960" rel="#L960">960</span>
<span id="L961" rel="#L961">961</span>
<span id="L962" rel="#L962">962</span>
<span id="L963" rel="#L963">963</span>
<span id="L964" rel="#L964">964</span>
<span id="L965" rel="#L965">965</span>
<span id="L966" rel="#L966">966</span>
<span id="L967" rel="#L967">967</span>
<span id="L968" rel="#L968">968</span>
<span id="L969" rel="#L969">969</span>
<span id="L970" rel="#L970">970</span>
<span id="L971" rel="#L971">971</span>
<span id="L972" rel="#L972">972</span>
<span id="L973" rel="#L973">973</span>
<span id="L974" rel="#L974">974</span>
<span id="L975" rel="#L975">975</span>
<span id="L976" rel="#L976">976</span>
<span id="L977" rel="#L977">977</span>
<span id="L978" rel="#L978">978</span>
<span id="L979" rel="#L979">979</span>
<span id="L980" rel="#L980">980</span>
<span id="L981" rel="#L981">981</span>
<span id="L982" rel="#L982">982</span>
<span id="L983" rel="#L983">983</span>
<span id="L984" rel="#L984">984</span>
<span id="L985" rel="#L985">985</span>
<span id="L986" rel="#L986">986</span>
<span id="L987" rel="#L987">987</span>
<span id="L988" rel="#L988">988</span>
<span id="L989" rel="#L989">989</span>
<span id="L990" rel="#L990">990</span>
<span id="L991" rel="#L991">991</span>
<span id="L992" rel="#L992">992</span>
<span id="L993" rel="#L993">993</span>
<span id="L994" rel="#L994">994</span>
<span id="L995" rel="#L995">995</span>
<span id="L996" rel="#L996">996</span>
<span id="L997" rel="#L997">997</span>
<span id="L998" rel="#L998">998</span>
<span id="L999" rel="#L999">999</span>
<span id="L1000" rel="#L1000">1000</span>
<span id="L1001" rel="#L1001">1001</span>
<span id="L1002" rel="#L1002">1002</span>
<span id="L1003" rel="#L1003">1003</span>
<span id="L1004" rel="#L1004">1004</span>
<span id="L1005" rel="#L1005">1005</span>
<span id="L1006" rel="#L1006">1006</span>
<span id="L1007" rel="#L1007">1007</span>
<span id="L1008" rel="#L1008">1008</span>
<span id="L1009" rel="#L1009">1009</span>
<span id="L1010" rel="#L1010">1010</span>
<span id="L1011" rel="#L1011">1011</span>
<span id="L1012" rel="#L1012">1012</span>
<span id="L1013" rel="#L1013">1013</span>
<span id="L1014" rel="#L1014">1014</span>
<span id="L1015" rel="#L1015">1015</span>
<span id="L1016" rel="#L1016">1016</span>
<span id="L1017" rel="#L1017">1017</span>
<span id="L1018" rel="#L1018">1018</span>
<span id="L1019" rel="#L1019">1019</span>
<span id="L1020" rel="#L1020">1020</span>
<span id="L1021" rel="#L1021">1021</span>
<span id="L1022" rel="#L1022">1022</span>
<span id="L1023" rel="#L1023">1023</span>
<span id="L1024" rel="#L1024">1024</span>
<span id="L1025" rel="#L1025">1025</span>
<span id="L1026" rel="#L1026">1026</span>
<span id="L1027" rel="#L1027">1027</span>
<span id="L1028" rel="#L1028">1028</span>
<span id="L1029" rel="#L1029">1029</span>
<span id="L1030" rel="#L1030">1030</span>
<span id="L1031" rel="#L1031">1031</span>
<span id="L1032" rel="#L1032">1032</span>
<span id="L1033" rel="#L1033">1033</span>
<span id="L1034" rel="#L1034">1034</span>
<span id="L1035" rel="#L1035">1035</span>
<span id="L1036" rel="#L1036">1036</span>
<span id="L1037" rel="#L1037">1037</span>
<span id="L1038" rel="#L1038">1038</span>
<span id="L1039" rel="#L1039">1039</span>
<span id="L1040" rel="#L1040">1040</span>
<span id="L1041" rel="#L1041">1041</span>
<span id="L1042" rel="#L1042">1042</span>
<span id="L1043" rel="#L1043">1043</span>
<span id="L1044" rel="#L1044">1044</span>
<span id="L1045" rel="#L1045">1045</span>
<span id="L1046" rel="#L1046">1046</span>
<span id="L1047" rel="#L1047">1047</span>
<span id="L1048" rel="#L1048">1048</span>
<span id="L1049" rel="#L1049">1049</span>
<span id="L1050" rel="#L1050">1050</span>
<span id="L1051" rel="#L1051">1051</span>
<span id="L1052" rel="#L1052">1052</span>
<span id="L1053" rel="#L1053">1053</span>
<span id="L1054" rel="#L1054">1054</span>
<span id="L1055" rel="#L1055">1055</span>
<span id="L1056" rel="#L1056">1056</span>
<span id="L1057" rel="#L1057">1057</span>
<span id="L1058" rel="#L1058">1058</span>
<span id="L1059" rel="#L1059">1059</span>
<span id="L1060" rel="#L1060">1060</span>
<span id="L1061" rel="#L1061">1061</span>
<span id="L1062" rel="#L1062">1062</span>
<span id="L1063" rel="#L1063">1063</span>
<span id="L1064" rel="#L1064">1064</span>
<span id="L1065" rel="#L1065">1065</span>
<span id="L1066" rel="#L1066">1066</span>
<span id="L1067" rel="#L1067">1067</span>
<span id="L1068" rel="#L1068">1068</span>
<span id="L1069" rel="#L1069">1069</span>
<span id="L1070" rel="#L1070">1070</span>
<span id="L1071" rel="#L1071">1071</span>
<span id="L1072" rel="#L1072">1072</span>
<span id="L1073" rel="#L1073">1073</span>
<span id="L1074" rel="#L1074">1074</span>
<span id="L1075" rel="#L1075">1075</span>
<span id="L1076" rel="#L1076">1076</span>
<span id="L1077" rel="#L1077">1077</span>
<span id="L1078" rel="#L1078">1078</span>
<span id="L1079" rel="#L1079">1079</span>
<span id="L1080" rel="#L1080">1080</span>
<span id="L1081" rel="#L1081">1081</span>
<span id="L1082" rel="#L1082">1082</span>
<span id="L1083" rel="#L1083">1083</span>
<span id="L1084" rel="#L1084">1084</span>
<span id="L1085" rel="#L1085">1085</span>
<span id="L1086" rel="#L1086">1086</span>
<span id="L1087" rel="#L1087">1087</span>
<span id="L1088" rel="#L1088">1088</span>
<span id="L1089" rel="#L1089">1089</span>
<span id="L1090" rel="#L1090">1090</span>
<span id="L1091" rel="#L1091">1091</span>
<span id="L1092" rel="#L1092">1092</span>
<span id="L1093" rel="#L1093">1093</span>
<span id="L1094" rel="#L1094">1094</span>
<span id="L1095" rel="#L1095">1095</span>
<span id="L1096" rel="#L1096">1096</span>
<span id="L1097" rel="#L1097">1097</span>
<span id="L1098" rel="#L1098">1098</span>
<span id="L1099" rel="#L1099">1099</span>
<span id="L1100" rel="#L1100">1100</span>
<span id="L1101" rel="#L1101">1101</span>
<span id="L1102" rel="#L1102">1102</span>
<span id="L1103" rel="#L1103">1103</span>
<span id="L1104" rel="#L1104">1104</span>
<span id="L1105" rel="#L1105">1105</span>
<span id="L1106" rel="#L1106">1106</span>
<span id="L1107" rel="#L1107">1107</span>
<span id="L1108" rel="#L1108">1108</span>
<span id="L1109" rel="#L1109">1109</span>
<span id="L1110" rel="#L1110">1110</span>
<span id="L1111" rel="#L1111">1111</span>
<span id="L1112" rel="#L1112">1112</span>
<span id="L1113" rel="#L1113">1113</span>
<span id="L1114" rel="#L1114">1114</span>
<span id="L1115" rel="#L1115">1115</span>
<span id="L1116" rel="#L1116">1116</span>
<span id="L1117" rel="#L1117">1117</span>
<span id="L1118" rel="#L1118">1118</span>
<span id="L1119" rel="#L1119">1119</span>
<span id="L1120" rel="#L1120">1120</span>
<span id="L1121" rel="#L1121">1121</span>
<span id="L1122" rel="#L1122">1122</span>
<span id="L1123" rel="#L1123">1123</span>
<span id="L1124" rel="#L1124">1124</span>
<span id="L1125" rel="#L1125">1125</span>
<span id="L1126" rel="#L1126">1126</span>
<span id="L1127" rel="#L1127">1127</span>
<span id="L1128" rel="#L1128">1128</span>
<span id="L1129" rel="#L1129">1129</span>
<span id="L1130" rel="#L1130">1130</span>
<span id="L1131" rel="#L1131">1131</span>
<span id="L1132" rel="#L1132">1132</span>
<span id="L1133" rel="#L1133">1133</span>
<span id="L1134" rel="#L1134">1134</span>
<span id="L1135" rel="#L1135">1135</span>
<span id="L1136" rel="#L1136">1136</span>
<span id="L1137" rel="#L1137">1137</span>
<span id="L1138" rel="#L1138">1138</span>
<span id="L1139" rel="#L1139">1139</span>
<span id="L1140" rel="#L1140">1140</span>
<span id="L1141" rel="#L1141">1141</span>
<span id="L1142" rel="#L1142">1142</span>
<span id="L1143" rel="#L1143">1143</span>
<span id="L1144" rel="#L1144">1144</span>
<span id="L1145" rel="#L1145">1145</span>
<span id="L1146" rel="#L1146">1146</span>
<span id="L1147" rel="#L1147">1147</span>
<span id="L1148" rel="#L1148">1148</span>
<span id="L1149" rel="#L1149">1149</span>
<span id="L1150" rel="#L1150">1150</span>
<span id="L1151" rel="#L1151">1151</span>
<span id="L1152" rel="#L1152">1152</span>
<span id="L1153" rel="#L1153">1153</span>
<span id="L1154" rel="#L1154">1154</span>
<span id="L1155" rel="#L1155">1155</span>
<span id="L1156" rel="#L1156">1156</span>
<span id="L1157" rel="#L1157">1157</span>
<span id="L1158" rel="#L1158">1158</span>
<span id="L1159" rel="#L1159">1159</span>
<span id="L1160" rel="#L1160">1160</span>
<span id="L1161" rel="#L1161">1161</span>
<span id="L1162" rel="#L1162">1162</span>
<span id="L1163" rel="#L1163">1163</span>
<span id="L1164" rel="#L1164">1164</span>
<span id="L1165" rel="#L1165">1165</span>
<span id="L1166" rel="#L1166">1166</span>
<span id="L1167" rel="#L1167">1167</span>
<span id="L1168" rel="#L1168">1168</span>
<span id="L1169" rel="#L1169">1169</span>
<span id="L1170" rel="#L1170">1170</span>
<span id="L1171" rel="#L1171">1171</span>
<span id="L1172" rel="#L1172">1172</span>
<span id="L1173" rel="#L1173">1173</span>
<span id="L1174" rel="#L1174">1174</span>
<span id="L1175" rel="#L1175">1175</span>
<span id="L1176" rel="#L1176">1176</span>
<span id="L1177" rel="#L1177">1177</span>
<span id="L1178" rel="#L1178">1178</span>
<span id="L1179" rel="#L1179">1179</span>
<span id="L1180" rel="#L1180">1180</span>
<span id="L1181" rel="#L1181">1181</span>
<span id="L1182" rel="#L1182">1182</span>
<span id="L1183" rel="#L1183">1183</span>
<span id="L1184" rel="#L1184">1184</span>
<span id="L1185" rel="#L1185">1185</span>
<span id="L1186" rel="#L1186">1186</span>
<span id="L1187" rel="#L1187">1187</span>
<span id="L1188" rel="#L1188">1188</span>
<span id="L1189" rel="#L1189">1189</span>
<span id="L1190" rel="#L1190">1190</span>
<span id="L1191" rel="#L1191">1191</span>
<span id="L1192" rel="#L1192">1192</span>
<span id="L1193" rel="#L1193">1193</span>
<span id="L1194" rel="#L1194">1194</span>
<span id="L1195" rel="#L1195">1195</span>
<span id="L1196" rel="#L1196">1196</span>
<span id="L1197" rel="#L1197">1197</span>
<span id="L1198" rel="#L1198">1198</span>
<span id="L1199" rel="#L1199">1199</span>
<span id="L1200" rel="#L1200">1200</span>
<span id="L1201" rel="#L1201">1201</span>
<span id="L1202" rel="#L1202">1202</span>
<span id="L1203" rel="#L1203">1203</span>
<span id="L1204" rel="#L1204">1204</span>
<span id="L1205" rel="#L1205">1205</span>
<span id="L1206" rel="#L1206">1206</span>
<span id="L1207" rel="#L1207">1207</span>
<span id="L1208" rel="#L1208">1208</span>
<span id="L1209" rel="#L1209">1209</span>
<span id="L1210" rel="#L1210">1210</span>
<span id="L1211" rel="#L1211">1211</span>
<span id="L1212" rel="#L1212">1212</span>
<span id="L1213" rel="#L1213">1213</span>
<span id="L1214" rel="#L1214">1214</span>
<span id="L1215" rel="#L1215">1215</span>
<span id="L1216" rel="#L1216">1216</span>
<span id="L1217" rel="#L1217">1217</span>
<span id="L1218" rel="#L1218">1218</span>
<span id="L1219" rel="#L1219">1219</span>
<span id="L1220" rel="#L1220">1220</span>
<span id="L1221" rel="#L1221">1221</span>
<span id="L1222" rel="#L1222">1222</span>
<span id="L1223" rel="#L1223">1223</span>
<span id="L1224" rel="#L1224">1224</span>
<span id="L1225" rel="#L1225">1225</span>
<span id="L1226" rel="#L1226">1226</span>
<span id="L1227" rel="#L1227">1227</span>
<span id="L1228" rel="#L1228">1228</span>
<span id="L1229" rel="#L1229">1229</span>
<span id="L1230" rel="#L1230">1230</span>
<span id="L1231" rel="#L1231">1231</span>
<span id="L1232" rel="#L1232">1232</span>
<span id="L1233" rel="#L1233">1233</span>
<span id="L1234" rel="#L1234">1234</span>
<span id="L1235" rel="#L1235">1235</span>
<span id="L1236" rel="#L1236">1236</span>
<span id="L1237" rel="#L1237">1237</span>
<span id="L1238" rel="#L1238">1238</span>
<span id="L1239" rel="#L1239">1239</span>
<span id="L1240" rel="#L1240">1240</span>
<span id="L1241" rel="#L1241">1241</span>
<span id="L1242" rel="#L1242">1242</span>
<span id="L1243" rel="#L1243">1243</span>
<span id="L1244" rel="#L1244">1244</span>
<span id="L1245" rel="#L1245">1245</span>
<span id="L1246" rel="#L1246">1246</span>
<span id="L1247" rel="#L1247">1247</span>
<span id="L1248" rel="#L1248">1248</span>
<span id="L1249" rel="#L1249">1249</span>
<span id="L1250" rel="#L1250">1250</span>
<span id="L1251" rel="#L1251">1251</span>
<span id="L1252" rel="#L1252">1252</span>
<span id="L1253" rel="#L1253">1253</span>
<span id="L1254" rel="#L1254">1254</span>
<span id="L1255" rel="#L1255">1255</span>
<span id="L1256" rel="#L1256">1256</span>
<span id="L1257" rel="#L1257">1257</span>
<span id="L1258" rel="#L1258">1258</span>
<span id="L1259" rel="#L1259">1259</span>
<span id="L1260" rel="#L1260">1260</span>
<span id="L1261" rel="#L1261">1261</span>
<span id="L1262" rel="#L1262">1262</span>
<span id="L1263" rel="#L1263">1263</span>
<span id="L1264" rel="#L1264">1264</span>
<span id="L1265" rel="#L1265">1265</span>
<span id="L1266" rel="#L1266">1266</span>
<span id="L1267" rel="#L1267">1267</span>
<span id="L1268" rel="#L1268">1268</span>
<span id="L1269" rel="#L1269">1269</span>
</pre>
          </td>
          <td width="100%">
                <div class="highlight"><pre><div class='line' id='LC1'><span class="cp">&lt;?php</span></div><div class='line' id='LC2'><span class="sd">/**</span></div><div class='line' id='LC3'><span class="sd"> * Copyright 2011 Facebook, Inc.</span></div><div class='line' id='LC4'><span class="sd"> *</span></div><div class='line' id='LC5'><span class="sd"> * Licensed under the Apache License, Version 2.0 (the &quot;License&quot;); you may</span></div><div class='line' id='LC6'><span class="sd"> * not use this file except in compliance with the License. You may obtain</span></div><div class='line' id='LC7'><span class="sd"> * a copy of the License at</span></div><div class='line' id='LC8'><span class="sd"> *</span></div><div class='line' id='LC9'><span class="sd"> *     http://www.apache.org/licenses/LICENSE-2.0</span></div><div class='line' id='LC10'><span class="sd"> *</span></div><div class='line' id='LC11'><span class="sd"> * Unless required by applicable law or agreed to in writing, software</span></div><div class='line' id='LC12'><span class="sd"> * distributed under the License is distributed on an &quot;AS IS&quot; BASIS, WITHOUT</span></div><div class='line' id='LC13'><span class="sd"> * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the</span></div><div class='line' id='LC14'><span class="sd"> * License for the specific language governing permissions and limitations</span></div><div class='line' id='LC15'><span class="sd"> * under the License.</span></div><div class='line' id='LC16'><span class="sd"> */</span></div><div class='line' id='LC17'><br/></div><div class='line' id='LC18'><span class="k">if</span> <span class="p">(</span><span class="o">!</span><span class="nb">function_exists</span><span class="p">(</span><span class="s1">&#39;curl_init&#39;</span><span class="p">))</span> <span class="p">{</span></div><div class='line' id='LC19'>&nbsp;&nbsp;<span class="k">throw</span> <span class="k">new</span> <span class="nx">Exception</span><span class="p">(</span><span class="s1">&#39;Facebook needs the CURL PHP extension.&#39;</span><span class="p">);</span></div><div class='line' id='LC20'><span class="p">}</span></div><div class='line' id='LC21'><span class="k">if</span> <span class="p">(</span><span class="o">!</span><span class="nb">function_exists</span><span class="p">(</span><span class="s1">&#39;json_decode&#39;</span><span class="p">))</span> <span class="p">{</span></div><div class='line' id='LC22'>&nbsp;&nbsp;<span class="k">throw</span> <span class="k">new</span> <span class="nx">Exception</span><span class="p">(</span><span class="s1">&#39;Facebook needs the JSON PHP extension.&#39;</span><span class="p">);</span></div><div class='line' id='LC23'><span class="p">}</span></div><div class='line' id='LC24'><br/></div><div class='line' id='LC25'><span class="sd">/**</span></div><div class='line' id='LC26'><span class="sd"> * Thrown when an API call returns an exception.</span></div><div class='line' id='LC27'><span class="sd"> *</span></div><div class='line' id='LC28'><span class="sd"> * @author Naitik Shah &lt;naitik@facebook.com&gt;</span></div><div class='line' id='LC29'><span class="sd"> */</span></div><div class='line' id='LC30'><span class="k">class</span> <span class="nc">FacebookApiException</span> <span class="k">extends</span> <span class="nx">Exception</span></div><div class='line' id='LC31'><span class="p">{</span></div><div class='line' id='LC32'>&nbsp;&nbsp;<span class="sd">/**</span></div><div class='line' id='LC33'><span class="sd">   * The result from the API server that represents the exception information.</span></div><div class='line' id='LC34'><span class="sd">   */</span></div><div class='line' id='LC35'>&nbsp;&nbsp;<span class="k">protected</span> <span class="nv">$result</span><span class="p">;</span></div><div class='line' id='LC36'><br/></div><div class='line' id='LC37'>&nbsp;&nbsp;<span class="sd">/**</span></div><div class='line' id='LC38'><span class="sd">   * Make a new API Exception with the given result.</span></div><div class='line' id='LC39'><span class="sd">   *</span></div><div class='line' id='LC40'><span class="sd">   * @param array $result The result from the API server</span></div><div class='line' id='LC41'><span class="sd">   */</span></div><div class='line' id='LC42'>&nbsp;&nbsp;<span class="k">public</span> <span class="k">function</span> <span class="nf">__construct</span><span class="p">(</span><span class="nv">$result</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC43'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$this</span><span class="o">-&gt;</span><span class="na">result</span> <span class="o">=</span> <span class="nv">$result</span><span class="p">;</span></div><div class='line' id='LC44'><br/></div><div class='line' id='LC45'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$code</span> <span class="o">=</span> <span class="nb">isset</span><span class="p">(</span><span class="nv">$result</span><span class="p">[</span><span class="s1">&#39;error_code&#39;</span><span class="p">])</span> <span class="o">?</span> <span class="nv">$result</span><span class="p">[</span><span class="s1">&#39;error_code&#39;</span><span class="p">]</span> <span class="o">:</span> <span class="mi">0</span><span class="p">;</span></div><div class='line' id='LC46'><br/></div><div class='line' id='LC47'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">if</span> <span class="p">(</span><span class="nb">isset</span><span class="p">(</span><span class="nv">$result</span><span class="p">[</span><span class="s1">&#39;error_description&#39;</span><span class="p">]))</span> <span class="p">{</span></div><div class='line' id='LC48'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="c1">// OAuth 2.0 Draft 10 style</span></div><div class='line' id='LC49'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$msg</span> <span class="o">=</span> <span class="nv">$result</span><span class="p">[</span><span class="s1">&#39;error_description&#39;</span><span class="p">];</span></div><div class='line' id='LC50'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">}</span> <span class="k">else</span> <span class="k">if</span> <span class="p">(</span><span class="nb">isset</span><span class="p">(</span><span class="nv">$result</span><span class="p">[</span><span class="s1">&#39;error&#39;</span><span class="p">])</span> <span class="o">&amp;&amp;</span> <span class="nb">is_array</span><span class="p">(</span><span class="nv">$result</span><span class="p">[</span><span class="s1">&#39;error&#39;</span><span class="p">]))</span> <span class="p">{</span></div><div class='line' id='LC51'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="c1">// OAuth 2.0 Draft 00 style</span></div><div class='line' id='LC52'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$msg</span> <span class="o">=</span> <span class="nv">$result</span><span class="p">[</span><span class="s1">&#39;error&#39;</span><span class="p">][</span><span class="s1">&#39;message&#39;</span><span class="p">];</span></div><div class='line' id='LC53'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">}</span> <span class="k">else</span> <span class="k">if</span> <span class="p">(</span><span class="nb">isset</span><span class="p">(</span><span class="nv">$result</span><span class="p">[</span><span class="s1">&#39;error_msg&#39;</span><span class="p">]))</span> <span class="p">{</span></div><div class='line' id='LC54'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="c1">// Rest server style</span></div><div class='line' id='LC55'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$msg</span> <span class="o">=</span> <span class="nv">$result</span><span class="p">[</span><span class="s1">&#39;error_msg&#39;</span><span class="p">];</span></div><div class='line' id='LC56'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">}</span> <span class="k">else</span> <span class="p">{</span></div><div class='line' id='LC57'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$msg</span> <span class="o">=</span> <span class="s1">&#39;Unknown Error. Check getResult()&#39;</span><span class="p">;</span></div><div class='line' id='LC58'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC59'><br/></div><div class='line' id='LC60'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">parent</span><span class="o">::</span><span class="na">__construct</span><span class="p">(</span><span class="nv">$msg</span><span class="p">,</span> <span class="nv">$code</span><span class="p">);</span></div><div class='line' id='LC61'>&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC62'><br/></div><div class='line' id='LC63'>&nbsp;&nbsp;<span class="sd">/**</span></div><div class='line' id='LC64'><span class="sd">   * Return the associated result object returned by the API server.</span></div><div class='line' id='LC65'><span class="sd">   *</span></div><div class='line' id='LC66'><span class="sd">   * @return array The result from the API server</span></div><div class='line' id='LC67'><span class="sd">   */</span></div><div class='line' id='LC68'>&nbsp;&nbsp;<span class="k">public</span> <span class="k">function</span> <span class="nf">getResult</span><span class="p">()</span> <span class="p">{</span></div><div class='line' id='LC69'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">return</span> <span class="nv">$this</span><span class="o">-&gt;</span><span class="na">result</span><span class="p">;</span></div><div class='line' id='LC70'>&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC71'><br/></div><div class='line' id='LC72'>&nbsp;&nbsp;<span class="sd">/**</span></div><div class='line' id='LC73'><span class="sd">   * Returns the associated type for the error. This will default to</span></div><div class='line' id='LC74'><span class="sd">   * &#39;Exception&#39; when a type is not available.</span></div><div class='line' id='LC75'><span class="sd">   *</span></div><div class='line' id='LC76'><span class="sd">   * @return string</span></div><div class='line' id='LC77'><span class="sd">   */</span></div><div class='line' id='LC78'>&nbsp;&nbsp;<span class="k">public</span> <span class="k">function</span> <span class="nf">getType</span><span class="p">()</span> <span class="p">{</span></div><div class='line' id='LC79'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">if</span> <span class="p">(</span><span class="nb">isset</span><span class="p">(</span><span class="nv">$this</span><span class="o">-&gt;</span><span class="na">result</span><span class="p">[</span><span class="s1">&#39;error&#39;</span><span class="p">]))</span> <span class="p">{</span></div><div class='line' id='LC80'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$error</span> <span class="o">=</span> <span class="nv">$this</span><span class="o">-&gt;</span><span class="na">result</span><span class="p">[</span><span class="s1">&#39;error&#39;</span><span class="p">];</span></div><div class='line' id='LC81'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">if</span> <span class="p">(</span><span class="nb">is_string</span><span class="p">(</span><span class="nv">$error</span><span class="p">))</span> <span class="p">{</span></div><div class='line' id='LC82'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="c1">// OAuth 2.0 Draft 10 style</span></div><div class='line' id='LC83'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">return</span> <span class="nv">$error</span><span class="p">;</span></div><div class='line' id='LC84'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">}</span> <span class="k">else</span> <span class="k">if</span> <span class="p">(</span><span class="nb">is_array</span><span class="p">(</span><span class="nv">$error</span><span class="p">))</span> <span class="p">{</span></div><div class='line' id='LC85'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="c1">// OAuth 2.0 Draft 00 style</span></div><div class='line' id='LC86'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">if</span> <span class="p">(</span><span class="nb">isset</span><span class="p">(</span><span class="nv">$error</span><span class="p">[</span><span class="s1">&#39;type&#39;</span><span class="p">]))</span> <span class="p">{</span></div><div class='line' id='LC87'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">return</span> <span class="nv">$error</span><span class="p">[</span><span class="s1">&#39;type&#39;</span><span class="p">];</span></div><div class='line' id='LC88'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC89'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC90'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC91'><br/></div><div class='line' id='LC92'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">return</span> <span class="s1">&#39;Exception&#39;</span><span class="p">;</span></div><div class='line' id='LC93'>&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC94'><br/></div><div class='line' id='LC95'>&nbsp;&nbsp;<span class="sd">/**</span></div><div class='line' id='LC96'><span class="sd">   * To make debugging easier.</span></div><div class='line' id='LC97'><span class="sd">   *</span></div><div class='line' id='LC98'><span class="sd">   * @return string The string representation of the error</span></div><div class='line' id='LC99'><span class="sd">   */</span></div><div class='line' id='LC100'>&nbsp;&nbsp;<span class="k">public</span> <span class="k">function</span> <span class="nf">__toString</span><span class="p">()</span> <span class="p">{</span></div><div class='line' id='LC101'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$str</span> <span class="o">=</span> <span class="nv">$this</span><span class="o">-&gt;</span><span class="na">getType</span><span class="p">()</span> <span class="o">.</span> <span class="s1">&#39;: &#39;</span><span class="p">;</span></div><div class='line' id='LC102'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">if</span> <span class="p">(</span><span class="nv">$this</span><span class="o">-&gt;</span><span class="na">code</span> <span class="o">!=</span> <span class="mi">0</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC103'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$str</span> <span class="o">.=</span> <span class="nv">$this</span><span class="o">-&gt;</span><span class="na">code</span> <span class="o">.</span> <span class="s1">&#39;: &#39;</span><span class="p">;</span></div><div class='line' id='LC104'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC105'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">return</span> <span class="nv">$str</span> <span class="o">.</span> <span class="nv">$this</span><span class="o">-&gt;</span><span class="na">message</span><span class="p">;</span></div><div class='line' id='LC106'>&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC107'><span class="p">}</span></div><div class='line' id='LC108'><br/></div><div class='line' id='LC109'><span class="sd">/**</span></div><div class='line' id='LC110'><span class="sd"> * Provides access to the Facebook Platform.  This class provides</span></div><div class='line' id='LC111'><span class="sd"> * a majority of the functionality needed, but the class is abstract</span></div><div class='line' id='LC112'><span class="sd"> * because it is designed to be sub-classed.  The subclass must</span></div><div class='line' id='LC113'><span class="sd"> * implement the four abstract methods listed at the bottom of</span></div><div class='line' id='LC114'><span class="sd"> * the file.</span></div><div class='line' id='LC115'><span class="sd"> *</span></div><div class='line' id='LC116'><span class="sd"> * @author Naitik Shah &lt;naitik@facebook.com&gt;</span></div><div class='line' id='LC117'><span class="sd"> */</span></div><div class='line' id='LC118'><span class="k">abstract</span> <span class="k">class</span> <span class="nc">BaseFacebook</span></div><div class='line' id='LC119'><span class="p">{</span></div><div class='line' id='LC120'>&nbsp;&nbsp;<span class="sd">/**</span></div><div class='line' id='LC121'><span class="sd">   * Version.</span></div><div class='line' id='LC122'><span class="sd">   */</span></div><div class='line' id='LC123'>&nbsp;&nbsp;<span class="k">const</span> <span class="no">VERSION</span> <span class="o">=</span> <span class="s1">&#39;3.1.1&#39;</span><span class="p">;</span></div><div class='line' id='LC124'><br/></div><div class='line' id='LC125'>&nbsp;&nbsp;<span class="sd">/**</span></div><div class='line' id='LC126'><span class="sd">   * Default options for curl.</span></div><div class='line' id='LC127'><span class="sd">   */</span></div><div class='line' id='LC128'>&nbsp;&nbsp;<span class="k">public</span> <span class="k">static</span> <span class="nv">$CURL_OPTS</span> <span class="o">=</span> <span class="k">array</span><span class="p">(</span></div><div class='line' id='LC129'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="nx">CURLOPT_CONNECTTIMEOUT</span> <span class="o">=&gt;</span> <span class="mi">10</span><span class="p">,</span></div><div class='line' id='LC130'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="nx">CURLOPT_RETURNTRANSFER</span> <span class="o">=&gt;</span> <span class="k">true</span><span class="p">,</span></div><div class='line' id='LC131'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="nx">CURLOPT_TIMEOUT</span>        <span class="o">=&gt;</span> <span class="mi">60</span><span class="p">,</span></div><div class='line' id='LC132'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="nx">CURLOPT_USERAGENT</span>      <span class="o">=&gt;</span> <span class="s1">&#39;facebook-php-3.1&#39;</span><span class="p">,</span></div><div class='line' id='LC133'>&nbsp;&nbsp;<span class="p">);</span></div><div class='line' id='LC134'><br/></div><div class='line' id='LC135'>&nbsp;&nbsp;<span class="sd">/**</span></div><div class='line' id='LC136'><span class="sd">   * List of query parameters that get automatically dropped when rebuilding</span></div><div class='line' id='LC137'><span class="sd">   * the current URL.</span></div><div class='line' id='LC138'><span class="sd">   */</span></div><div class='line' id='LC139'>&nbsp;&nbsp;<span class="k">protected</span> <span class="k">static</span> <span class="nv">$DROP_QUERY_PARAMS</span> <span class="o">=</span> <span class="k">array</span><span class="p">(</span></div><div class='line' id='LC140'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="s1">&#39;code&#39;</span><span class="p">,</span></div><div class='line' id='LC141'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="s1">&#39;state&#39;</span><span class="p">,</span></div><div class='line' id='LC142'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="s1">&#39;signed_request&#39;</span><span class="p">,</span></div><div class='line' id='LC143'>&nbsp;&nbsp;<span class="p">);</span></div><div class='line' id='LC144'><br/></div><div class='line' id='LC145'>&nbsp;&nbsp;<span class="sd">/**</span></div><div class='line' id='LC146'><span class="sd">   * Maps aliases to Facebook domains.</span></div><div class='line' id='LC147'><span class="sd">   */</span></div><div class='line' id='LC148'>&nbsp;&nbsp;<span class="k">public</span> <span class="k">static</span> <span class="nv">$DOMAIN_MAP</span> <span class="o">=</span> <span class="k">array</span><span class="p">(</span></div><div class='line' id='LC149'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="s1">&#39;api&#39;</span>       <span class="o">=&gt;</span> <span class="s1">&#39;https://api.facebook.com/&#39;</span><span class="p">,</span></div><div class='line' id='LC150'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="s1">&#39;api_video&#39;</span> <span class="o">=&gt;</span> <span class="s1">&#39;https://api-video.facebook.com/&#39;</span><span class="p">,</span></div><div class='line' id='LC151'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="s1">&#39;api_read&#39;</span>  <span class="o">=&gt;</span> <span class="s1">&#39;https://api-read.facebook.com/&#39;</span><span class="p">,</span></div><div class='line' id='LC152'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="s1">&#39;graph&#39;</span>     <span class="o">=&gt;</span> <span class="s1">&#39;https://graph.facebook.com/&#39;</span><span class="p">,</span></div><div class='line' id='LC153'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="s1">&#39;graph_video&#39;</span> <span class="o">=&gt;</span> <span class="s1">&#39;https://graph-video.facebook.com/&#39;</span><span class="p">,</span></div><div class='line' id='LC154'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="s1">&#39;www&#39;</span>       <span class="o">=&gt;</span> <span class="s1">&#39;https://www.facebook.com/&#39;</span><span class="p">,</span></div><div class='line' id='LC155'>&nbsp;&nbsp;<span class="p">);</span></div><div class='line' id='LC156'><br/></div><div class='line' id='LC157'>&nbsp;&nbsp;<span class="sd">/**</span></div><div class='line' id='LC158'><span class="sd">   * The Application ID.</span></div><div class='line' id='LC159'><span class="sd">   *</span></div><div class='line' id='LC160'><span class="sd">   * @var string</span></div><div class='line' id='LC161'><span class="sd">   */</span></div><div class='line' id='LC162'>&nbsp;&nbsp;<span class="k">protected</span> <span class="nv">$appId</span><span class="p">;</span></div><div class='line' id='LC163'><br/></div><div class='line' id='LC164'>&nbsp;&nbsp;<span class="sd">/**</span></div><div class='line' id='LC165'><span class="sd">   * The Application App Secret.</span></div><div class='line' id='LC166'><span class="sd">   *</span></div><div class='line' id='LC167'><span class="sd">   * @var string</span></div><div class='line' id='LC168'><span class="sd">   */</span></div><div class='line' id='LC169'>&nbsp;&nbsp;<span class="k">protected</span> <span class="nv">$appSecret</span><span class="p">;</span></div><div class='line' id='LC170'><br/></div><div class='line' id='LC171'>&nbsp;&nbsp;<span class="sd">/**</span></div><div class='line' id='LC172'><span class="sd">   * The ID of the Facebook user, or 0 if the user is logged out.</span></div><div class='line' id='LC173'><span class="sd">   *</span></div><div class='line' id='LC174'><span class="sd">   * @var integer</span></div><div class='line' id='LC175'><span class="sd">   */</span></div><div class='line' id='LC176'>&nbsp;&nbsp;<span class="k">protected</span> <span class="nv">$user</span><span class="p">;</span></div><div class='line' id='LC177'><br/></div><div class='line' id='LC178'>&nbsp;&nbsp;<span class="sd">/**</span></div><div class='line' id='LC179'><span class="sd">   * The data from the signed_request token.</span></div><div class='line' id='LC180'><span class="sd">   */</span></div><div class='line' id='LC181'>&nbsp;&nbsp;<span class="k">protected</span> <span class="nv">$signedRequest</span><span class="p">;</span></div><div class='line' id='LC182'><br/></div><div class='line' id='LC183'>&nbsp;&nbsp;<span class="sd">/**</span></div><div class='line' id='LC184'><span class="sd">   * A CSRF state variable to assist in the defense against CSRF attacks.</span></div><div class='line' id='LC185'><span class="sd">   */</span></div><div class='line' id='LC186'>&nbsp;&nbsp;<span class="k">protected</span> <span class="nv">$state</span><span class="p">;</span></div><div class='line' id='LC187'><br/></div><div class='line' id='LC188'>&nbsp;&nbsp;<span class="sd">/**</span></div><div class='line' id='LC189'><span class="sd">   * The OAuth access token received in exchange for a valid authorization</span></div><div class='line' id='LC190'><span class="sd">   * code.  null means the access token has yet to be determined.</span></div><div class='line' id='LC191'><span class="sd">   *</span></div><div class='line' id='LC192'><span class="sd">   * @var string</span></div><div class='line' id='LC193'><span class="sd">   */</span></div><div class='line' id='LC194'>&nbsp;&nbsp;<span class="k">protected</span> <span class="nv">$accessToken</span> <span class="o">=</span> <span class="k">null</span><span class="p">;</span></div><div class='line' id='LC195'><br/></div><div class='line' id='LC196'>&nbsp;&nbsp;<span class="sd">/**</span></div><div class='line' id='LC197'><span class="sd">   * Indicates if the CURL based @ syntax for file uploads is enabled.</span></div><div class='line' id='LC198'><span class="sd">   *</span></div><div class='line' id='LC199'><span class="sd">   * @var boolean</span></div><div class='line' id='LC200'><span class="sd">   */</span></div><div class='line' id='LC201'>&nbsp;&nbsp;<span class="k">protected</span> <span class="nv">$fileUploadSupport</span> <span class="o">=</span> <span class="k">false</span><span class="p">;</span></div><div class='line' id='LC202'><br/></div><div class='line' id='LC203'>&nbsp;&nbsp;<span class="sd">/**</span></div><div class='line' id='LC204'><span class="sd">   * Initialize a Facebook Application.</span></div><div class='line' id='LC205'><span class="sd">   *</span></div><div class='line' id='LC206'><span class="sd">   * The configuration:</span></div><div class='line' id='LC207'><span class="sd">   * - appId: the application ID</span></div><div class='line' id='LC208'><span class="sd">   * - secret: the application secret</span></div><div class='line' id='LC209'><span class="sd">   * - fileUpload: (optional) boolean indicating if file uploads are enabled</span></div><div class='line' id='LC210'><span class="sd">   *</span></div><div class='line' id='LC211'><span class="sd">   * @param array $config The application configuration</span></div><div class='line' id='LC212'><span class="sd">   */</span></div><div class='line' id='LC213'>&nbsp;&nbsp;<span class="k">public</span> <span class="k">function</span> <span class="nf">__construct</span><span class="p">(</span><span class="nv">$config</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC214'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$this</span><span class="o">-&gt;</span><span class="na">setAppId</span><span class="p">(</span><span class="nv">$config</span><span class="p">[</span><span class="s1">&#39;appId&#39;</span><span class="p">]);</span></div><div class='line' id='LC215'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$this</span><span class="o">-&gt;</span><span class="na">setAppSecret</span><span class="p">(</span><span class="nv">$config</span><span class="p">[</span><span class="s1">&#39;secret&#39;</span><span class="p">]);</span></div><div class='line' id='LC216'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">if</span> <span class="p">(</span><span class="nb">isset</span><span class="p">(</span><span class="nv">$config</span><span class="p">[</span><span class="s1">&#39;fileUpload&#39;</span><span class="p">]))</span> <span class="p">{</span></div><div class='line' id='LC217'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$this</span><span class="o">-&gt;</span><span class="na">setFileUploadSupport</span><span class="p">(</span><span class="nv">$config</span><span class="p">[</span><span class="s1">&#39;fileUpload&#39;</span><span class="p">]);</span></div><div class='line' id='LC218'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC219'><br/></div><div class='line' id='LC220'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$state</span> <span class="o">=</span> <span class="nv">$this</span><span class="o">-&gt;</span><span class="na">getPersistentData</span><span class="p">(</span><span class="s1">&#39;state&#39;</span><span class="p">);</span></div><div class='line' id='LC221'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">if</span> <span class="p">(</span><span class="o">!</span><span class="k">empty</span><span class="p">(</span><span class="nv">$state</span><span class="p">))</span> <span class="p">{</span></div><div class='line' id='LC222'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$this</span><span class="o">-&gt;</span><span class="na">state</span> <span class="o">=</span> <span class="nv">$this</span><span class="o">-&gt;</span><span class="na">getPersistentData</span><span class="p">(</span><span class="s1">&#39;state&#39;</span><span class="p">);</span></div><div class='line' id='LC223'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC224'>&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC225'><br/></div><div class='line' id='LC226'>&nbsp;&nbsp;<span class="sd">/**</span></div><div class='line' id='LC227'><span class="sd">   * Set the Application ID.</span></div><div class='line' id='LC228'><span class="sd">   *</span></div><div class='line' id='LC229'><span class="sd">   * @param string $appId The Application ID</span></div><div class='line' id='LC230'><span class="sd">   * @return BaseFacebook</span></div><div class='line' id='LC231'><span class="sd">   */</span></div><div class='line' id='LC232'>&nbsp;&nbsp;<span class="k">public</span> <span class="k">function</span> <span class="nf">setAppId</span><span class="p">(</span><span class="nv">$appId</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC233'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$this</span><span class="o">-&gt;</span><span class="na">appId</span> <span class="o">=</span> <span class="nv">$appId</span><span class="p">;</span></div><div class='line' id='LC234'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">return</span> <span class="nv">$this</span><span class="p">;</span></div><div class='line' id='LC235'>&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC236'><br/></div><div class='line' id='LC237'>&nbsp;&nbsp;<span class="sd">/**</span></div><div class='line' id='LC238'><span class="sd">   * Get the Application ID.</span></div><div class='line' id='LC239'><span class="sd">   *</span></div><div class='line' id='LC240'><span class="sd">   * @return string the Application ID</span></div><div class='line' id='LC241'><span class="sd">   */</span></div><div class='line' id='LC242'>&nbsp;&nbsp;<span class="k">public</span> <span class="k">function</span> <span class="nf">getAppId</span><span class="p">()</span> <span class="p">{</span></div><div class='line' id='LC243'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">return</span> <span class="nv">$this</span><span class="o">-&gt;</span><span class="na">appId</span><span class="p">;</span></div><div class='line' id='LC244'>&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC245'><br/></div><div class='line' id='LC246'>&nbsp;&nbsp;<span class="sd">/**</span></div><div class='line' id='LC247'><span class="sd">   * Set the App Secret.</span></div><div class='line' id='LC248'><span class="sd">   *</span></div><div class='line' id='LC249'><span class="sd">   * @param string $apiSecret The App Secret</span></div><div class='line' id='LC250'><span class="sd">   * @return BaseFacebook</span></div><div class='line' id='LC251'><span class="sd">   * @deprecated</span></div><div class='line' id='LC252'><span class="sd">   */</span></div><div class='line' id='LC253'>&nbsp;&nbsp;<span class="k">public</span> <span class="k">function</span> <span class="nf">setApiSecret</span><span class="p">(</span><span class="nv">$apiSecret</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC254'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$this</span><span class="o">-&gt;</span><span class="na">setAppSecret</span><span class="p">(</span><span class="nv">$apiSecret</span><span class="p">);</span></div><div class='line' id='LC255'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">return</span> <span class="nv">$this</span><span class="p">;</span></div><div class='line' id='LC256'>&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC257'><br/></div><div class='line' id='LC258'>&nbsp;&nbsp;<span class="sd">/**</span></div><div class='line' id='LC259'><span class="sd">   * Set the App Secret.</span></div><div class='line' id='LC260'><span class="sd">   *</span></div><div class='line' id='LC261'><span class="sd">   * @param string $appSecret The App Secret</span></div><div class='line' id='LC262'><span class="sd">   * @return BaseFacebook</span></div><div class='line' id='LC263'><span class="sd">   */</span></div><div class='line' id='LC264'>&nbsp;&nbsp;<span class="k">public</span> <span class="k">function</span> <span class="nf">setAppSecret</span><span class="p">(</span><span class="nv">$appSecret</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC265'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$this</span><span class="o">-&gt;</span><span class="na">appSecret</span> <span class="o">=</span> <span class="nv">$appSecret</span><span class="p">;</span></div><div class='line' id='LC266'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">return</span> <span class="nv">$this</span><span class="p">;</span></div><div class='line' id='LC267'>&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC268'><br/></div><div class='line' id='LC269'>&nbsp;&nbsp;<span class="sd">/**</span></div><div class='line' id='LC270'><span class="sd">   * Get the App Secret.</span></div><div class='line' id='LC271'><span class="sd">   *</span></div><div class='line' id='LC272'><span class="sd">   * @return string the App Secret</span></div><div class='line' id='LC273'><span class="sd">   * @deprecated</span></div><div class='line' id='LC274'><span class="sd">   */</span></div><div class='line' id='LC275'>&nbsp;&nbsp;<span class="k">public</span> <span class="k">function</span> <span class="nf">getApiSecret</span><span class="p">()</span> <span class="p">{</span></div><div class='line' id='LC276'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">return</span> <span class="nv">$this</span><span class="o">-&gt;</span><span class="na">getAppSecret</span><span class="p">();</span></div><div class='line' id='LC277'>&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC278'><br/></div><div class='line' id='LC279'>&nbsp;&nbsp;<span class="sd">/**</span></div><div class='line' id='LC280'><span class="sd">   * Get the App Secret.</span></div><div class='line' id='LC281'><span class="sd">   *</span></div><div class='line' id='LC282'><span class="sd">   * @return string the App Secret</span></div><div class='line' id='LC283'><span class="sd">   */</span></div><div class='line' id='LC284'>&nbsp;&nbsp;<span class="k">public</span> <span class="k">function</span> <span class="nf">getAppSecret</span><span class="p">()</span> <span class="p">{</span></div><div class='line' id='LC285'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">return</span> <span class="nv">$this</span><span class="o">-&gt;</span><span class="na">appSecret</span><span class="p">;</span></div><div class='line' id='LC286'>&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC287'><br/></div><div class='line' id='LC288'>&nbsp;&nbsp;<span class="sd">/**</span></div><div class='line' id='LC289'><span class="sd">   * Set the file upload support status.</span></div><div class='line' id='LC290'><span class="sd">   *</span></div><div class='line' id='LC291'><span class="sd">   * @param boolean $fileUploadSupport The file upload support status.</span></div><div class='line' id='LC292'><span class="sd">   * @return BaseFacebook</span></div><div class='line' id='LC293'><span class="sd">   */</span></div><div class='line' id='LC294'>&nbsp;&nbsp;<span class="k">public</span> <span class="k">function</span> <span class="nf">setFileUploadSupport</span><span class="p">(</span><span class="nv">$fileUploadSupport</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC295'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$this</span><span class="o">-&gt;</span><span class="na">fileUploadSupport</span> <span class="o">=</span> <span class="nv">$fileUploadSupport</span><span class="p">;</span></div><div class='line' id='LC296'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">return</span> <span class="nv">$this</span><span class="p">;</span></div><div class='line' id='LC297'>&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC298'><br/></div><div class='line' id='LC299'>&nbsp;&nbsp;<span class="sd">/**</span></div><div class='line' id='LC300'><span class="sd">   * Get the file upload support status.</span></div><div class='line' id='LC301'><span class="sd">   *</span></div><div class='line' id='LC302'><span class="sd">   * @return boolean true if and only if the server supports file upload.</span></div><div class='line' id='LC303'><span class="sd">   */</span></div><div class='line' id='LC304'>&nbsp;&nbsp;<span class="k">public</span> <span class="k">function</span> <span class="nf">getFileUploadSupport</span><span class="p">()</span> <span class="p">{</span></div><div class='line' id='LC305'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">return</span> <span class="nv">$this</span><span class="o">-&gt;</span><span class="na">fileUploadSupport</span><span class="p">;</span></div><div class='line' id='LC306'>&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC307'><br/></div><div class='line' id='LC308'>&nbsp;&nbsp;<span class="sd">/**</span></div><div class='line' id='LC309'><span class="sd">   * DEPRECATED! Please use getFileUploadSupport instead.</span></div><div class='line' id='LC310'><span class="sd">   *</span></div><div class='line' id='LC311'><span class="sd">   * Get the file upload support status.</span></div><div class='line' id='LC312'><span class="sd">   *</span></div><div class='line' id='LC313'><span class="sd">   * @return boolean true if and only if the server supports file upload.</span></div><div class='line' id='LC314'><span class="sd">   */</span></div><div class='line' id='LC315'>&nbsp;&nbsp;<span class="k">public</span> <span class="k">function</span> <span class="nf">useFileUploadSupport</span><span class="p">()</span> <span class="p">{</span></div><div class='line' id='LC316'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">return</span> <span class="nv">$this</span><span class="o">-&gt;</span><span class="na">getFileUploadSupport</span><span class="p">();</span></div><div class='line' id='LC317'>&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC318'><br/></div><div class='line' id='LC319'>&nbsp;&nbsp;<span class="sd">/**</span></div><div class='line' id='LC320'><span class="sd">   * Sets the access token for api calls.  Use this if you get</span></div><div class='line' id='LC321'><span class="sd">   * your access token by other means and just want the SDK</span></div><div class='line' id='LC322'><span class="sd">   * to use it.</span></div><div class='line' id='LC323'><span class="sd">   *</span></div><div class='line' id='LC324'><span class="sd">   * @param string $access_token an access token.</span></div><div class='line' id='LC325'><span class="sd">   * @return BaseFacebook</span></div><div class='line' id='LC326'><span class="sd">   */</span></div><div class='line' id='LC327'>&nbsp;&nbsp;<span class="k">public</span> <span class="k">function</span> <span class="nf">setAccessToken</span><span class="p">(</span><span class="nv">$access_token</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC328'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$this</span><span class="o">-&gt;</span><span class="na">accessToken</span> <span class="o">=</span> <span class="nv">$access_token</span><span class="p">;</span></div><div class='line' id='LC329'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">return</span> <span class="nv">$this</span><span class="p">;</span></div><div class='line' id='LC330'>&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC331'><br/></div><div class='line' id='LC332'>&nbsp;&nbsp;<span class="sd">/**</span></div><div class='line' id='LC333'><span class="sd">   * Determines the access token that should be used for API calls.</span></div><div class='line' id='LC334'><span class="sd">   * The first time this is called, $this-&gt;accessToken is set equal</span></div><div class='line' id='LC335'><span class="sd">   * to either a valid user access token, or it&#39;s set to the application</span></div><div class='line' id='LC336'><span class="sd">   * access token if a valid user access token wasn&#39;t available.  Subsequent</span></div><div class='line' id='LC337'><span class="sd">   * calls return whatever the first call returned.</span></div><div class='line' id='LC338'><span class="sd">   *</span></div><div class='line' id='LC339'><span class="sd">   * @return string The access token</span></div><div class='line' id='LC340'><span class="sd">   */</span></div><div class='line' id='LC341'>&nbsp;&nbsp;<span class="k">public</span> <span class="k">function</span> <span class="nf">getAccessToken</span><span class="p">()</span> <span class="p">{</span></div><div class='line' id='LC342'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">if</span> <span class="p">(</span><span class="nv">$this</span><span class="o">-&gt;</span><span class="na">accessToken</span> <span class="o">!==</span> <span class="k">null</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC343'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="c1">// we&#39;ve done this already and cached it.  Just return.</span></div><div class='line' id='LC344'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">return</span> <span class="nv">$this</span><span class="o">-&gt;</span><span class="na">accessToken</span><span class="p">;</span></div><div class='line' id='LC345'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC346'><br/></div><div class='line' id='LC347'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="c1">// first establish access token to be the application</span></div><div class='line' id='LC348'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="c1">// access token, in case we navigate to the /oauth/access_token</span></div><div class='line' id='LC349'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="c1">// endpoint, where SOME access token is required.</span></div><div class='line' id='LC350'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$this</span><span class="o">-&gt;</span><span class="na">setAccessToken</span><span class="p">(</span><span class="nv">$this</span><span class="o">-&gt;</span><span class="na">getApplicationAccessToken</span><span class="p">());</span></div><div class='line' id='LC351'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$user_access_token</span> <span class="o">=</span> <span class="nv">$this</span><span class="o">-&gt;</span><span class="na">getUserAccessToken</span><span class="p">();</span></div><div class='line' id='LC352'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">if</span> <span class="p">(</span><span class="nv">$user_access_token</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC353'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$this</span><span class="o">-&gt;</span><span class="na">setAccessToken</span><span class="p">(</span><span class="nv">$user_access_token</span><span class="p">);</span></div><div class='line' id='LC354'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC355'><br/></div><div class='line' id='LC356'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">return</span> <span class="nv">$this</span><span class="o">-&gt;</span><span class="na">accessToken</span><span class="p">;</span></div><div class='line' id='LC357'>&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC358'><br/></div><div class='line' id='LC359'>&nbsp;&nbsp;<span class="sd">/**</span></div><div class='line' id='LC360'><span class="sd">   * Determines and returns the user access token, first using</span></div><div class='line' id='LC361'><span class="sd">   * the signed request if present, and then falling back on</span></div><div class='line' id='LC362'><span class="sd">   * the authorization code if present.  The intent is to</span></div><div class='line' id='LC363'><span class="sd">   * return a valid user access token, or false if one is determined</span></div><div class='line' id='LC364'><span class="sd">   * to not be available.</span></div><div class='line' id='LC365'><span class="sd">   *</span></div><div class='line' id='LC366'><span class="sd">   * @return string A valid user access token, or false if one</span></div><div class='line' id='LC367'><span class="sd">   *                could not be determined.</span></div><div class='line' id='LC368'><span class="sd">   */</span></div><div class='line' id='LC369'>&nbsp;&nbsp;<span class="k">protected</span> <span class="k">function</span> <span class="nf">getUserAccessToken</span><span class="p">()</span> <span class="p">{</span></div><div class='line' id='LC370'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="c1">// first, consider a signed request if it&#39;s supplied.</span></div><div class='line' id='LC371'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="c1">// if there is a signed request, then it alone determines</span></div><div class='line' id='LC372'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="c1">// the access token.</span></div><div class='line' id='LC373'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$signed_request</span> <span class="o">=</span> <span class="nv">$this</span><span class="o">-&gt;</span><span class="na">getSignedRequest</span><span class="p">();</span></div><div class='line' id='LC374'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">if</span> <span class="p">(</span><span class="nv">$signed_request</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC375'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="c1">// apps.facebook.com hands the access_token in the signed_request</span></div><div class='line' id='LC376'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">if</span> <span class="p">(</span><span class="nb">array_key_exists</span><span class="p">(</span><span class="s1">&#39;oauth_token&#39;</span><span class="p">,</span> <span class="nv">$signed_request</span><span class="p">))</span> <span class="p">{</span></div><div class='line' id='LC377'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$access_token</span> <span class="o">=</span> <span class="nv">$signed_request</span><span class="p">[</span><span class="s1">&#39;oauth_token&#39;</span><span class="p">];</span></div><div class='line' id='LC378'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$this</span><span class="o">-&gt;</span><span class="na">setPersistentData</span><span class="p">(</span><span class="s1">&#39;access_token&#39;</span><span class="p">,</span> <span class="nv">$access_token</span><span class="p">);</span></div><div class='line' id='LC379'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">return</span> <span class="nv">$access_token</span><span class="p">;</span></div><div class='line' id='LC380'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC381'><br/></div><div class='line' id='LC382'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="c1">// the JS SDK puts a code in with the redirect_uri of &#39;&#39;</span></div><div class='line' id='LC383'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">if</span> <span class="p">(</span><span class="nb">array_key_exists</span><span class="p">(</span><span class="s1">&#39;code&#39;</span><span class="p">,</span> <span class="nv">$signed_request</span><span class="p">))</span> <span class="p">{</span></div><div class='line' id='LC384'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$code</span> <span class="o">=</span> <span class="nv">$signed_request</span><span class="p">[</span><span class="s1">&#39;code&#39;</span><span class="p">];</span></div><div class='line' id='LC385'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$access_token</span> <span class="o">=</span> <span class="nv">$this</span><span class="o">-&gt;</span><span class="na">getAccessTokenFromCode</span><span class="p">(</span><span class="nv">$code</span><span class="p">,</span> <span class="s1">&#39;&#39;</span><span class="p">);</span></div><div class='line' id='LC386'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">if</span> <span class="p">(</span><span class="nv">$access_token</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC387'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$this</span><span class="o">-&gt;</span><span class="na">setPersistentData</span><span class="p">(</span><span class="s1">&#39;code&#39;</span><span class="p">,</span> <span class="nv">$code</span><span class="p">);</span></div><div class='line' id='LC388'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$this</span><span class="o">-&gt;</span><span class="na">setPersistentData</span><span class="p">(</span><span class="s1">&#39;access_token&#39;</span><span class="p">,</span> <span class="nv">$access_token</span><span class="p">);</span></div><div class='line' id='LC389'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">return</span> <span class="nv">$access_token</span><span class="p">;</span></div><div class='line' id='LC390'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC391'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC392'><br/></div><div class='line' id='LC393'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="c1">// signed request states there&#39;s no access token, so anything</span></div><div class='line' id='LC394'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="c1">// stored should be cleared.</span></div><div class='line' id='LC395'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$this</span><span class="o">-&gt;</span><span class="na">clearAllPersistentData</span><span class="p">();</span></div><div class='line' id='LC396'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">return</span> <span class="k">false</span><span class="p">;</span> <span class="c1">// respect the signed request&#39;s data, even</span></div><div class='line' id='LC397'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="c1">// if there&#39;s an authorization code or something else</span></div><div class='line' id='LC398'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC399'><br/></div><div class='line' id='LC400'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$code</span> <span class="o">=</span> <span class="nv">$this</span><span class="o">-&gt;</span><span class="na">getCode</span><span class="p">();</span></div><div class='line' id='LC401'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">if</span> <span class="p">(</span><span class="nv">$code</span> <span class="o">&amp;&amp;</span> <span class="nv">$code</span> <span class="o">!=</span> <span class="nv">$this</span><span class="o">-&gt;</span><span class="na">getPersistentData</span><span class="p">(</span><span class="s1">&#39;code&#39;</span><span class="p">))</span> <span class="p">{</span></div><div class='line' id='LC402'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$access_token</span> <span class="o">=</span> <span class="nv">$this</span><span class="o">-&gt;</span><span class="na">getAccessTokenFromCode</span><span class="p">(</span><span class="nv">$code</span><span class="p">);</span></div><div class='line' id='LC403'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">if</span> <span class="p">(</span><span class="nv">$access_token</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC404'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$this</span><span class="o">-&gt;</span><span class="na">setPersistentData</span><span class="p">(</span><span class="s1">&#39;code&#39;</span><span class="p">,</span> <span class="nv">$code</span><span class="p">);</span></div><div class='line' id='LC405'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$this</span><span class="o">-&gt;</span><span class="na">setPersistentData</span><span class="p">(</span><span class="s1">&#39;access_token&#39;</span><span class="p">,</span> <span class="nv">$access_token</span><span class="p">);</span></div><div class='line' id='LC406'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">return</span> <span class="nv">$access_token</span><span class="p">;</span></div><div class='line' id='LC407'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC408'><br/></div><div class='line' id='LC409'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="c1">// code was bogus, so everything based on it should be invalidated.</span></div><div class='line' id='LC410'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$this</span><span class="o">-&gt;</span><span class="na">clearAllPersistentData</span><span class="p">();</span></div><div class='line' id='LC411'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">return</span> <span class="k">false</span><span class="p">;</span></div><div class='line' id='LC412'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC413'><br/></div><div class='line' id='LC414'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="c1">// as a fallback, just return whatever is in the persistent</span></div><div class='line' id='LC415'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="c1">// store, knowing nothing explicit (signed request, authorization</span></div><div class='line' id='LC416'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="c1">// code, etc.) was present to shadow it (or we saw a code in $_REQUEST,</span></div><div class='line' id='LC417'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="c1">// but it&#39;s the same as what&#39;s in the persistent store)</span></div><div class='line' id='LC418'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">return</span> <span class="nv">$this</span><span class="o">-&gt;</span><span class="na">getPersistentData</span><span class="p">(</span><span class="s1">&#39;access_token&#39;</span><span class="p">);</span></div><div class='line' id='LC419'>&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC420'><br/></div><div class='line' id='LC421'>&nbsp;&nbsp;<span class="sd">/**</span></div><div class='line' id='LC422'><span class="sd">   * Retrieve the signed request, either from a request parameter or,</span></div><div class='line' id='LC423'><span class="sd">   * if not present, from a cookie.</span></div><div class='line' id='LC424'><span class="sd">   *</span></div><div class='line' id='LC425'><span class="sd">   * @return string the signed request, if available, or null otherwise.</span></div><div class='line' id='LC426'><span class="sd">   */</span></div><div class='line' id='LC427'>&nbsp;&nbsp;<span class="k">public</span> <span class="k">function</span> <span class="nf">getSignedRequest</span><span class="p">()</span> <span class="p">{</span></div><div class='line' id='LC428'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">if</span> <span class="p">(</span><span class="o">!</span><span class="nv">$this</span><span class="o">-&gt;</span><span class="na">signedRequest</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC429'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">if</span> <span class="p">(</span><span class="nb">isset</span><span class="p">(</span><span class="nv">$_REQUEST</span><span class="p">[</span><span class="s1">&#39;signed_request&#39;</span><span class="p">]))</span> <span class="p">{</span></div><div class='line' id='LC430'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$this</span><span class="o">-&gt;</span><span class="na">signedRequest</span> <span class="o">=</span> <span class="nv">$this</span><span class="o">-&gt;</span><span class="na">parseSignedRequest</span><span class="p">(</span></div><div class='line' id='LC431'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$_REQUEST</span><span class="p">[</span><span class="s1">&#39;signed_request&#39;</span><span class="p">]);</span></div><div class='line' id='LC432'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">}</span> <span class="k">else</span> <span class="k">if</span> <span class="p">(</span><span class="nb">isset</span><span class="p">(</span><span class="nv">$_COOKIE</span><span class="p">[</span><span class="nv">$this</span><span class="o">-&gt;</span><span class="na">getSignedRequestCookieName</span><span class="p">()]))</span> <span class="p">{</span></div><div class='line' id='LC433'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$this</span><span class="o">-&gt;</span><span class="na">signedRequest</span> <span class="o">=</span> <span class="nv">$this</span><span class="o">-&gt;</span><span class="na">parseSignedRequest</span><span class="p">(</span></div><div class='line' id='LC434'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$_COOKIE</span><span class="p">[</span><span class="nv">$this</span><span class="o">-&gt;</span><span class="na">getSignedRequestCookieName</span><span class="p">()]);</span></div><div class='line' id='LC435'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC436'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC437'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">return</span> <span class="nv">$this</span><span class="o">-&gt;</span><span class="na">signedRequest</span><span class="p">;</span></div><div class='line' id='LC438'>&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC439'><br/></div><div class='line' id='LC440'>&nbsp;&nbsp;<span class="sd">/**</span></div><div class='line' id='LC441'><span class="sd">   * Get the UID of the connected user, or 0</span></div><div class='line' id='LC442'><span class="sd">   * if the Facebook user is not connected.</span></div><div class='line' id='LC443'><span class="sd">   *</span></div><div class='line' id='LC444'><span class="sd">   * @return string the UID if available.</span></div><div class='line' id='LC445'><span class="sd">   */</span></div><div class='line' id='LC446'>&nbsp;&nbsp;<span class="k">public</span> <span class="k">function</span> <span class="nf">getUser</span><span class="p">()</span> <span class="p">{</span></div><div class='line' id='LC447'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">if</span> <span class="p">(</span><span class="nv">$this</span><span class="o">-&gt;</span><span class="na">user</span> <span class="o">!==</span> <span class="k">null</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC448'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="c1">// we&#39;ve already determined this and cached the value.</span></div><div class='line' id='LC449'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">return</span> <span class="nv">$this</span><span class="o">-&gt;</span><span class="na">user</span><span class="p">;</span></div><div class='line' id='LC450'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC451'><br/></div><div class='line' id='LC452'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">return</span> <span class="nv">$this</span><span class="o">-&gt;</span><span class="na">user</span> <span class="o">=</span> <span class="nv">$this</span><span class="o">-&gt;</span><span class="na">getUserFromAvailableData</span><span class="p">();</span></div><div class='line' id='LC453'>&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC454'><br/></div><div class='line' id='LC455'>&nbsp;&nbsp;<span class="sd">/**</span></div><div class='line' id='LC456'><span class="sd">   * Determines the connected user by first examining any signed</span></div><div class='line' id='LC457'><span class="sd">   * requests, then considering an authorization code, and then</span></div><div class='line' id='LC458'><span class="sd">   * falling back to any persistent store storing the user.</span></div><div class='line' id='LC459'><span class="sd">   *</span></div><div class='line' id='LC460'><span class="sd">   * @return integer The id of the connected Facebook user,</span></div><div class='line' id='LC461'><span class="sd">   *                 or 0 if no such user exists.</span></div><div class='line' id='LC462'><span class="sd">   */</span></div><div class='line' id='LC463'>&nbsp;&nbsp;<span class="k">protected</span> <span class="k">function</span> <span class="nf">getUserFromAvailableData</span><span class="p">()</span> <span class="p">{</span></div><div class='line' id='LC464'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="c1">// if a signed request is supplied, then it solely determines</span></div><div class='line' id='LC465'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="c1">// who the user is.</span></div><div class='line' id='LC466'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$signed_request</span> <span class="o">=</span> <span class="nv">$this</span><span class="o">-&gt;</span><span class="na">getSignedRequest</span><span class="p">();</span></div><div class='line' id='LC467'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">if</span> <span class="p">(</span><span class="nv">$signed_request</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC468'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">if</span> <span class="p">(</span><span class="nb">array_key_exists</span><span class="p">(</span><span class="s1">&#39;user_id&#39;</span><span class="p">,</span> <span class="nv">$signed_request</span><span class="p">))</span> <span class="p">{</span></div><div class='line' id='LC469'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$user</span> <span class="o">=</span> <span class="nv">$signed_request</span><span class="p">[</span><span class="s1">&#39;user_id&#39;</span><span class="p">];</span></div><div class='line' id='LC470'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$this</span><span class="o">-&gt;</span><span class="na">setPersistentData</span><span class="p">(</span><span class="s1">&#39;user_id&#39;</span><span class="p">,</span> <span class="nv">$signed_request</span><span class="p">[</span><span class="s1">&#39;user_id&#39;</span><span class="p">]);</span></div><div class='line' id='LC471'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">return</span> <span class="nv">$user</span><span class="p">;</span></div><div class='line' id='LC472'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC473'><br/></div><div class='line' id='LC474'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="c1">// if the signed request didn&#39;t present a user id, then invalidate</span></div><div class='line' id='LC475'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="c1">// all entries in any persistent store.</span></div><div class='line' id='LC476'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$this</span><span class="o">-&gt;</span><span class="na">clearAllPersistentData</span><span class="p">();</span></div><div class='line' id='LC477'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">return</span> <span class="mi">0</span><span class="p">;</span></div><div class='line' id='LC478'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC479'><br/></div><div class='line' id='LC480'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$user</span> <span class="o">=</span> <span class="nv">$this</span><span class="o">-&gt;</span><span class="na">getPersistentData</span><span class="p">(</span><span class="s1">&#39;user_id&#39;</span><span class="p">,</span> <span class="nv">$default</span> <span class="o">=</span> <span class="mi">0</span><span class="p">);</span></div><div class='line' id='LC481'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$persisted_access_token</span> <span class="o">=</span> <span class="nv">$this</span><span class="o">-&gt;</span><span class="na">getPersistentData</span><span class="p">(</span><span class="s1">&#39;access_token&#39;</span><span class="p">);</span></div><div class='line' id='LC482'><br/></div><div class='line' id='LC483'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="c1">// use access_token to fetch user id if we have a user access_token, or if</span></div><div class='line' id='LC484'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="c1">// the cached access token has changed.</span></div><div class='line' id='LC485'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$access_token</span> <span class="o">=</span> <span class="nv">$this</span><span class="o">-&gt;</span><span class="na">getAccessToken</span><span class="p">();</span></div><div class='line' id='LC486'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">if</span> <span class="p">(</span><span class="nv">$access_token</span> <span class="o">&amp;&amp;</span></div><div class='line' id='LC487'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$access_token</span> <span class="o">!=</span> <span class="nv">$this</span><span class="o">-&gt;</span><span class="na">getApplicationAccessToken</span><span class="p">()</span> <span class="o">&amp;&amp;</span></div><div class='line' id='LC488'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="o">!</span><span class="p">(</span><span class="nv">$user</span> <span class="o">&amp;&amp;</span> <span class="nv">$persisted_access_token</span> <span class="o">==</span> <span class="nv">$access_token</span><span class="p">))</span> <span class="p">{</span></div><div class='line' id='LC489'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$user</span> <span class="o">=</span> <span class="nv">$this</span><span class="o">-&gt;</span><span class="na">getUserFromAccessToken</span><span class="p">();</span></div><div class='line' id='LC490'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">if</span> <span class="p">(</span><span class="nv">$user</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC491'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$this</span><span class="o">-&gt;</span><span class="na">setPersistentData</span><span class="p">(</span><span class="s1">&#39;user_id&#39;</span><span class="p">,</span> <span class="nv">$user</span><span class="p">);</span></div><div class='line' id='LC492'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">}</span> <span class="k">else</span> <span class="p">{</span></div><div class='line' id='LC493'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$this</span><span class="o">-&gt;</span><span class="na">clearAllPersistentData</span><span class="p">();</span></div><div class='line' id='LC494'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC495'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC496'><br/></div><div class='line' id='LC497'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">return</span> <span class="nv">$user</span><span class="p">;</span></div><div class='line' id='LC498'>&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC499'><br/></div><div class='line' id='LC500'>&nbsp;&nbsp;<span class="sd">/**</span></div><div class='line' id='LC501'><span class="sd">   * Get a Login URL for use with redirects. By default, full page redirect is</span></div><div class='line' id='LC502'><span class="sd">   * assumed. If you are using the generated URL with a window.open() call in</span></div><div class='line' id='LC503'><span class="sd">   * JavaScript, you can pass in display=popup as part of the $params.</span></div><div class='line' id='LC504'><span class="sd">   *</span></div><div class='line' id='LC505'><span class="sd">   * The parameters:</span></div><div class='line' id='LC506'><span class="sd">   * - redirect_uri: the url to go to after a successful login</span></div><div class='line' id='LC507'><span class="sd">   * - scope: comma separated list of requested extended perms</span></div><div class='line' id='LC508'><span class="sd">   *</span></div><div class='line' id='LC509'><span class="sd">   * @param array $params Provide custom parameters</span></div><div class='line' id='LC510'><span class="sd">   * @return string The URL for the login flow</span></div><div class='line' id='LC511'><span class="sd">   */</span></div><div class='line' id='LC512'>&nbsp;&nbsp;<span class="k">public</span> <span class="k">function</span> <span class="nf">getLoginUrl</span><span class="p">(</span><span class="nv">$params</span><span class="o">=</span><span class="k">array</span><span class="p">())</span> <span class="p">{</span></div><div class='line' id='LC513'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$this</span><span class="o">-&gt;</span><span class="na">establishCSRFTokenState</span><span class="p">();</span></div><div class='line' id='LC514'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$currentUrl</span> <span class="o">=</span> <span class="nv">$this</span><span class="o">-&gt;</span><span class="na">getCurrentUrl</span><span class="p">();</span></div><div class='line' id='LC515'><br/></div><div class='line' id='LC516'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="c1">// if &#39;scope&#39; is passed as an array, convert to comma separated list</span></div><div class='line' id='LC517'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$scopeParams</span> <span class="o">=</span> <span class="nb">isset</span><span class="p">(</span><span class="nv">$params</span><span class="p">[</span><span class="s1">&#39;scope&#39;</span><span class="p">])</span> <span class="o">?</span> <span class="nv">$params</span><span class="p">[</span><span class="s1">&#39;scope&#39;</span><span class="p">]</span> <span class="o">:</span> <span class="k">null</span><span class="p">;</span></div><div class='line' id='LC518'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">if</span> <span class="p">(</span><span class="nv">$scopeParams</span> <span class="o">&amp;&amp;</span> <span class="nb">is_array</span><span class="p">(</span><span class="nv">$scopeParams</span><span class="p">))</span> <span class="p">{</span></div><div class='line' id='LC519'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$params</span><span class="p">[</span><span class="s1">&#39;scope&#39;</span><span class="p">]</span> <span class="o">=</span> <span class="nb">implode</span><span class="p">(</span><span class="s1">&#39;,&#39;</span><span class="p">,</span> <span class="nv">$scopeParams</span><span class="p">);</span></div><div class='line' id='LC520'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC521'><br/></div><div class='line' id='LC522'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">return</span> <span class="nv">$this</span><span class="o">-&gt;</span><span class="na">getUrl</span><span class="p">(</span></div><div class='line' id='LC523'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s1">&#39;www&#39;</span><span class="p">,</span></div><div class='line' id='LC524'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s1">&#39;dialog/oauth&#39;</span><span class="p">,</span></div><div class='line' id='LC525'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nb">array_merge</span><span class="p">(</span><span class="k">array</span><span class="p">(</span></div><div class='line' id='LC526'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s1">&#39;client_id&#39;</span> <span class="o">=&gt;</span> <span class="nv">$this</span><span class="o">-&gt;</span><span class="na">getAppId</span><span class="p">(),</span></div><div class='line' id='LC527'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s1">&#39;redirect_uri&#39;</span> <span class="o">=&gt;</span> <span class="nv">$currentUrl</span><span class="p">,</span> <span class="c1">// possibly overwritten</span></div><div class='line' id='LC528'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s1">&#39;state&#39;</span> <span class="o">=&gt;</span> <span class="nv">$this</span><span class="o">-&gt;</span><span class="na">state</span><span class="p">),</span></div><div class='line' id='LC529'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$params</span><span class="p">));</span></div><div class='line' id='LC530'>&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC531'><br/></div><div class='line' id='LC532'>&nbsp;&nbsp;<span class="sd">/**</span></div><div class='line' id='LC533'><span class="sd">   * Get a Logout URL suitable for use with redirects.</span></div><div class='line' id='LC534'><span class="sd">   *</span></div><div class='line' id='LC535'><span class="sd">   * The parameters:</span></div><div class='line' id='LC536'><span class="sd">   * - next: the url to go to after a successful logout</span></div><div class='line' id='LC537'><span class="sd">   *</span></div><div class='line' id='LC538'><span class="sd">   * @param array $params Provide custom parameters</span></div><div class='line' id='LC539'><span class="sd">   * @return string The URL for the logout flow</span></div><div class='line' id='LC540'><span class="sd">   */</span></div><div class='line' id='LC541'>&nbsp;&nbsp;<span class="k">public</span> <span class="k">function</span> <span class="nf">getLogoutUrl</span><span class="p">(</span><span class="nv">$params</span><span class="o">=</span><span class="k">array</span><span class="p">())</span> <span class="p">{</span></div><div class='line' id='LC542'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">return</span> <span class="nv">$this</span><span class="o">-&gt;</span><span class="na">getUrl</span><span class="p">(</span></div><div class='line' id='LC543'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s1">&#39;www&#39;</span><span class="p">,</span></div><div class='line' id='LC544'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s1">&#39;logout.php&#39;</span><span class="p">,</span></div><div class='line' id='LC545'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nb">array_merge</span><span class="p">(</span><span class="k">array</span><span class="p">(</span></div><div class='line' id='LC546'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s1">&#39;next&#39;</span> <span class="o">=&gt;</span> <span class="nv">$this</span><span class="o">-&gt;</span><span class="na">getCurrentUrl</span><span class="p">(),</span></div><div class='line' id='LC547'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s1">&#39;access_token&#39;</span> <span class="o">=&gt;</span> <span class="nv">$this</span><span class="o">-&gt;</span><span class="na">getAccessToken</span><span class="p">(),</span></div><div class='line' id='LC548'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">),</span> <span class="nv">$params</span><span class="p">)</span></div><div class='line' id='LC549'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">);</span></div><div class='line' id='LC550'>&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC551'><br/></div><div class='line' id='LC552'>&nbsp;&nbsp;<span class="sd">/**</span></div><div class='line' id='LC553'><span class="sd">   * Get a login status URL to fetch the status from Facebook.</span></div><div class='line' id='LC554'><span class="sd">   *</span></div><div class='line' id='LC555'><span class="sd">   * The parameters:</span></div><div class='line' id='LC556'><span class="sd">   * - ok_session: the URL to go to if a session is found</span></div><div class='line' id='LC557'><span class="sd">   * - no_session: the URL to go to if the user is not connected</span></div><div class='line' id='LC558'><span class="sd">   * - no_user: the URL to go to if the user is not signed into facebook</span></div><div class='line' id='LC559'><span class="sd">   *</span></div><div class='line' id='LC560'><span class="sd">   * @param array $params Provide custom parameters</span></div><div class='line' id='LC561'><span class="sd">   * @return string The URL for the logout flow</span></div><div class='line' id='LC562'><span class="sd">   */</span></div><div class='line' id='LC563'>&nbsp;&nbsp;<span class="k">public</span> <span class="k">function</span> <span class="nf">getLoginStatusUrl</span><span class="p">(</span><span class="nv">$params</span><span class="o">=</span><span class="k">array</span><span class="p">())</span> <span class="p">{</span></div><div class='line' id='LC564'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">return</span> <span class="nv">$this</span><span class="o">-&gt;</span><span class="na">getUrl</span><span class="p">(</span></div><div class='line' id='LC565'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s1">&#39;www&#39;</span><span class="p">,</span></div><div class='line' id='LC566'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s1">&#39;extern/login_status.php&#39;</span><span class="p">,</span></div><div class='line' id='LC567'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nb">array_merge</span><span class="p">(</span><span class="k">array</span><span class="p">(</span></div><div class='line' id='LC568'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s1">&#39;api_key&#39;</span> <span class="o">=&gt;</span> <span class="nv">$this</span><span class="o">-&gt;</span><span class="na">getAppId</span><span class="p">(),</span></div><div class='line' id='LC569'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s1">&#39;no_session&#39;</span> <span class="o">=&gt;</span> <span class="nv">$this</span><span class="o">-&gt;</span><span class="na">getCurrentUrl</span><span class="p">(),</span></div><div class='line' id='LC570'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s1">&#39;no_user&#39;</span> <span class="o">=&gt;</span> <span class="nv">$this</span><span class="o">-&gt;</span><span class="na">getCurrentUrl</span><span class="p">(),</span></div><div class='line' id='LC571'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s1">&#39;ok_session&#39;</span> <span class="o">=&gt;</span> <span class="nv">$this</span><span class="o">-&gt;</span><span class="na">getCurrentUrl</span><span class="p">(),</span></div><div class='line' id='LC572'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s1">&#39;session_version&#39;</span> <span class="o">=&gt;</span> <span class="mi">3</span><span class="p">,</span></div><div class='line' id='LC573'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">),</span> <span class="nv">$params</span><span class="p">)</span></div><div class='line' id='LC574'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">);</span></div><div class='line' id='LC575'>&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC576'><br/></div><div class='line' id='LC577'>&nbsp;&nbsp;<span class="sd">/**</span></div><div class='line' id='LC578'><span class="sd">   * Make an API call.</span></div><div class='line' id='LC579'><span class="sd">   *</span></div><div class='line' id='LC580'><span class="sd">   * @return mixed The decoded response</span></div><div class='line' id='LC581'><span class="sd">   */</span></div><div class='line' id='LC582'>&nbsp;&nbsp;<span class="k">public</span> <span class="k">function</span> <span class="nf">api</span><span class="p">(</span><span class="cm">/* polymorphic */</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC583'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$args</span> <span class="o">=</span> <span class="nb">func_get_args</span><span class="p">();</span></div><div class='line' id='LC584'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">if</span> <span class="p">(</span><span class="nb">is_array</span><span class="p">(</span><span class="nv">$args</span><span class="p">[</span><span class="mi">0</span><span class="p">]))</span> <span class="p">{</span></div><div class='line' id='LC585'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">return</span> <span class="nv">$this</span><span class="o">-&gt;</span><span class="na">_restserver</span><span class="p">(</span><span class="nv">$args</span><span class="p">[</span><span class="mi">0</span><span class="p">]);</span></div><div class='line' id='LC586'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">}</span> <span class="k">else</span> <span class="p">{</span></div><div class='line' id='LC587'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">return</span> <span class="nb">call_user_func_array</span><span class="p">(</span><span class="k">array</span><span class="p">(</span><span class="nv">$this</span><span class="p">,</span> <span class="s1">&#39;_graph&#39;</span><span class="p">),</span> <span class="nv">$args</span><span class="p">);</span></div><div class='line' id='LC588'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC589'>&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC590'><br/></div><div class='line' id='LC591'>&nbsp;&nbsp;<span class="sd">/**</span></div><div class='line' id='LC592'><span class="sd">   * Constructs and returns the name of the cookie that</span></div><div class='line' id='LC593'><span class="sd">   * potentially houses the signed request for the app user.</span></div><div class='line' id='LC594'><span class="sd">   * The cookie is not set by the BaseFacebook class, but</span></div><div class='line' id='LC595'><span class="sd">   * it may be set by the JavaScript SDK.</span></div><div class='line' id='LC596'><span class="sd">   *</span></div><div class='line' id='LC597'><span class="sd">   * @return string the name of the cookie that would house</span></div><div class='line' id='LC598'><span class="sd">   *         the signed request value.</span></div><div class='line' id='LC599'><span class="sd">   */</span></div><div class='line' id='LC600'>&nbsp;&nbsp;<span class="k">protected</span> <span class="k">function</span> <span class="nf">getSignedRequestCookieName</span><span class="p">()</span> <span class="p">{</span></div><div class='line' id='LC601'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">return</span> <span class="s1">&#39;fbsr_&#39;</span><span class="o">.</span><span class="nv">$this</span><span class="o">-&gt;</span><span class="na">getAppId</span><span class="p">();</span></div><div class='line' id='LC602'>&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC603'><br/></div><div class='line' id='LC604'>&nbsp;&nbsp;<span class="sd">/**</span></div><div class='line' id='LC605'><span class="sd">   * Constructs and returns the name of the coookie that potentially contain</span></div><div class='line' id='LC606'><span class="sd">   * metadata. The cookie is not set by the BaseFacebook class, but it may be</span></div><div class='line' id='LC607'><span class="sd">   * set by the JavaScript SDK.</span></div><div class='line' id='LC608'><span class="sd">   *</span></div><div class='line' id='LC609'><span class="sd">   * @return string the name of the cookie that would house metadata.</span></div><div class='line' id='LC610'><span class="sd">   */</span></div><div class='line' id='LC611'>&nbsp;&nbsp;<span class="k">protected</span> <span class="k">function</span> <span class="nf">getMetadataCookieName</span><span class="p">()</span> <span class="p">{</span></div><div class='line' id='LC612'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">return</span> <span class="s1">&#39;fbm_&#39;</span><span class="o">.</span><span class="nv">$this</span><span class="o">-&gt;</span><span class="na">getAppId</span><span class="p">();</span></div><div class='line' id='LC613'>&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC614'><br/></div><div class='line' id='LC615'>&nbsp;&nbsp;<span class="sd">/**</span></div><div class='line' id='LC616'><span class="sd">   * Get the authorization code from the query parameters, if it exists,</span></div><div class='line' id='LC617'><span class="sd">   * and otherwise return false to signal no authorization code was</span></div><div class='line' id='LC618'><span class="sd">   * discoverable.</span></div><div class='line' id='LC619'><span class="sd">   *</span></div><div class='line' id='LC620'><span class="sd">   * @return mixed The authorization code, or false if the authorization</span></div><div class='line' id='LC621'><span class="sd">   *               code could not be determined.</span></div><div class='line' id='LC622'><span class="sd">   */</span></div><div class='line' id='LC623'>&nbsp;&nbsp;<span class="k">protected</span> <span class="k">function</span> <span class="nf">getCode</span><span class="p">()</span> <span class="p">{</span></div><div class='line' id='LC624'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">if</span> <span class="p">(</span><span class="nb">isset</span><span class="p">(</span><span class="nv">$_REQUEST</span><span class="p">[</span><span class="s1">&#39;code&#39;</span><span class="p">]))</span> <span class="p">{</span></div><div class='line' id='LC625'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">if</span> <span class="p">(</span><span class="nv">$this</span><span class="o">-&gt;</span><span class="na">state</span> <span class="o">!==</span> <span class="k">null</span> <span class="o">&amp;&amp;</span></div><div class='line' id='LC626'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nb">isset</span><span class="p">(</span><span class="nv">$_REQUEST</span><span class="p">[</span><span class="s1">&#39;state&#39;</span><span class="p">])</span> <span class="o">&amp;&amp;</span></div><div class='line' id='LC627'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$this</span><span class="o">-&gt;</span><span class="na">state</span> <span class="o">===</span> <span class="nv">$_REQUEST</span><span class="p">[</span><span class="s1">&#39;state&#39;</span><span class="p">])</span> <span class="p">{</span></div><div class='line' id='LC628'><br/></div><div class='line' id='LC629'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="c1">// CSRF state has done its job, so clear it</span></div><div class='line' id='LC630'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$this</span><span class="o">-&gt;</span><span class="na">state</span> <span class="o">=</span> <span class="k">null</span><span class="p">;</span></div><div class='line' id='LC631'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$this</span><span class="o">-&gt;</span><span class="na">clearPersistentData</span><span class="p">(</span><span class="s1">&#39;state&#39;</span><span class="p">);</span></div><div class='line' id='LC632'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">return</span> <span class="nv">$_REQUEST</span><span class="p">[</span><span class="s1">&#39;code&#39;</span><span class="p">];</span></div><div class='line' id='LC633'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">}</span> <span class="k">else</span> <span class="p">{</span></div><div class='line' id='LC634'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nx">self</span><span class="o">::</span><span class="na">errorLog</span><span class="p">(</span><span class="s1">&#39;CSRF state token does not match one provided.&#39;</span><span class="p">);</span></div><div class='line' id='LC635'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">return</span> <span class="k">false</span><span class="p">;</span></div><div class='line' id='LC636'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC637'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC638'><br/></div><div class='line' id='LC639'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">return</span> <span class="k">false</span><span class="p">;</span></div><div class='line' id='LC640'>&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC641'><br/></div><div class='line' id='LC642'>&nbsp;&nbsp;<span class="sd">/**</span></div><div class='line' id='LC643'><span class="sd">   * Retrieves the UID with the understanding that</span></div><div class='line' id='LC644'><span class="sd">   * $this-&gt;accessToken has already been set and is</span></div><div class='line' id='LC645'><span class="sd">   * seemingly legitimate.  It relies on Facebook&#39;s Graph API</span></div><div class='line' id='LC646'><span class="sd">   * to retrieve user information and then extract</span></div><div class='line' id='LC647'><span class="sd">   * the user ID.</span></div><div class='line' id='LC648'><span class="sd">   *</span></div><div class='line' id='LC649'><span class="sd">   * @return integer Returns the UID of the Facebook user, or 0</span></div><div class='line' id='LC650'><span class="sd">   *                 if the Facebook user could not be determined.</span></div><div class='line' id='LC651'><span class="sd">   */</span></div><div class='line' id='LC652'>&nbsp;&nbsp;<span class="k">protected</span> <span class="k">function</span> <span class="nf">getUserFromAccessToken</span><span class="p">()</span> <span class="p">{</span></div><div class='line' id='LC653'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">try</span> <span class="p">{</span></div><div class='line' id='LC654'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$user_info</span> <span class="o">=</span> <span class="nv">$this</span><span class="o">-&gt;</span><span class="na">api</span><span class="p">(</span><span class="s1">&#39;/me&#39;</span><span class="p">);</span></div><div class='line' id='LC655'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">return</span> <span class="nv">$user_info</span><span class="p">[</span><span class="s1">&#39;id&#39;</span><span class="p">];</span></div><div class='line' id='LC656'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">}</span> <span class="k">catch</span> <span class="p">(</span><span class="nx">FacebookApiException</span> <span class="nv">$e</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC657'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">return</span> <span class="mi">0</span><span class="p">;</span></div><div class='line' id='LC658'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC659'>&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC660'><br/></div><div class='line' id='LC661'>&nbsp;&nbsp;<span class="sd">/**</span></div><div class='line' id='LC662'><span class="sd">   * Returns the access token that should be used for logged out</span></div><div class='line' id='LC663'><span class="sd">   * users when no authorization code is available.</span></div><div class='line' id='LC664'><span class="sd">   *</span></div><div class='line' id='LC665'><span class="sd">   * @return string The application access token, useful for gathering</span></div><div class='line' id='LC666'><span class="sd">   *                public information about users and applications.</span></div><div class='line' id='LC667'><span class="sd">   */</span></div><div class='line' id='LC668'>&nbsp;&nbsp;<span class="k">protected</span> <span class="k">function</span> <span class="nf">getApplicationAccessToken</span><span class="p">()</span> <span class="p">{</span></div><div class='line' id='LC669'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">return</span> <span class="nv">$this</span><span class="o">-&gt;</span><span class="na">appId</span><span class="o">.</span><span class="s1">&#39;|&#39;</span><span class="o">.</span><span class="nv">$this</span><span class="o">-&gt;</span><span class="na">appSecret</span><span class="p">;</span></div><div class='line' id='LC670'>&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC671'><br/></div><div class='line' id='LC672'>&nbsp;&nbsp;<span class="sd">/**</span></div><div class='line' id='LC673'><span class="sd">   * Lays down a CSRF state token for this process.</span></div><div class='line' id='LC674'><span class="sd">   *</span></div><div class='line' id='LC675'><span class="sd">   * @return void</span></div><div class='line' id='LC676'><span class="sd">   */</span></div><div class='line' id='LC677'>&nbsp;&nbsp;<span class="k">protected</span> <span class="k">function</span> <span class="nf">establishCSRFTokenState</span><span class="p">()</span> <span class="p">{</span></div><div class='line' id='LC678'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">if</span> <span class="p">(</span><span class="nv">$this</span><span class="o">-&gt;</span><span class="na">state</span> <span class="o">===</span> <span class="k">null</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC679'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$this</span><span class="o">-&gt;</span><span class="na">state</span> <span class="o">=</span> <span class="nb">md5</span><span class="p">(</span><span class="nb">uniqid</span><span class="p">(</span><span class="nx">mt_rand</span><span class="p">(),</span> <span class="k">true</span><span class="p">));</span></div><div class='line' id='LC680'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$this</span><span class="o">-&gt;</span><span class="na">setPersistentData</span><span class="p">(</span><span class="s1">&#39;state&#39;</span><span class="p">,</span> <span class="nv">$this</span><span class="o">-&gt;</span><span class="na">state</span><span class="p">);</span></div><div class='line' id='LC681'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC682'>&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC683'><br/></div><div class='line' id='LC684'>&nbsp;&nbsp;<span class="sd">/**</span></div><div class='line' id='LC685'><span class="sd">   * Retrieves an access token for the given authorization code</span></div><div class='line' id='LC686'><span class="sd">   * (previously generated from www.facebook.com on behalf of</span></div><div class='line' id='LC687'><span class="sd">   * a specific user).  The authorization code is sent to graph.facebook.com</span></div><div class='line' id='LC688'><span class="sd">   * and a legitimate access token is generated provided the access token</span></div><div class='line' id='LC689'><span class="sd">   * and the user for which it was generated all match, and the user is</span></div><div class='line' id='LC690'><span class="sd">   * either logged in to Facebook or has granted an offline access permission.</span></div><div class='line' id='LC691'><span class="sd">   *</span></div><div class='line' id='LC692'><span class="sd">   * @param string $code An authorization code.</span></div><div class='line' id='LC693'><span class="sd">   * @return mixed An access token exchanged for the authorization code, or</span></div><div class='line' id='LC694'><span class="sd">   *               false if an access token could not be generated.</span></div><div class='line' id='LC695'><span class="sd">   */</span></div><div class='line' id='LC696'>&nbsp;&nbsp;<span class="k">protected</span> <span class="k">function</span> <span class="nf">getAccessTokenFromCode</span><span class="p">(</span><span class="nv">$code</span><span class="p">,</span> <span class="nv">$redirect_uri</span> <span class="o">=</span> <span class="k">null</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC697'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">if</span> <span class="p">(</span><span class="k">empty</span><span class="p">(</span><span class="nv">$code</span><span class="p">))</span> <span class="p">{</span></div><div class='line' id='LC698'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">return</span> <span class="k">false</span><span class="p">;</span></div><div class='line' id='LC699'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC700'><br/></div><div class='line' id='LC701'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">if</span> <span class="p">(</span><span class="nv">$redirect_uri</span> <span class="o">===</span> <span class="k">null</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC702'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$redirect_uri</span> <span class="o">=</span> <span class="nv">$this</span><span class="o">-&gt;</span><span class="na">getCurrentUrl</span><span class="p">();</span></div><div class='line' id='LC703'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC704'><br/></div><div class='line' id='LC705'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">try</span> <span class="p">{</span></div><div class='line' id='LC706'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="c1">// need to circumvent json_decode by calling _oauthRequest</span></div><div class='line' id='LC707'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="c1">// directly, since response isn&#39;t JSON format.</span></div><div class='line' id='LC708'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$access_token_response</span> <span class="o">=</span></div><div class='line' id='LC709'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$this</span><span class="o">-&gt;</span><span class="na">_oauthRequest</span><span class="p">(</span></div><div class='line' id='LC710'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$this</span><span class="o">-&gt;</span><span class="na">getUrl</span><span class="p">(</span><span class="s1">&#39;graph&#39;</span><span class="p">,</span> <span class="s1">&#39;/oauth/access_token&#39;</span><span class="p">),</span></div><div class='line' id='LC711'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$params</span> <span class="o">=</span> <span class="k">array</span><span class="p">(</span><span class="s1">&#39;client_id&#39;</span> <span class="o">=&gt;</span> <span class="nv">$this</span><span class="o">-&gt;</span><span class="na">getAppId</span><span class="p">(),</span></div><div class='line' id='LC712'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s1">&#39;client_secret&#39;</span> <span class="o">=&gt;</span> <span class="nv">$this</span><span class="o">-&gt;</span><span class="na">getAppSecret</span><span class="p">(),</span></div><div class='line' id='LC713'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s1">&#39;redirect_uri&#39;</span> <span class="o">=&gt;</span> <span class="nv">$redirect_uri</span><span class="p">,</span></div><div class='line' id='LC714'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s1">&#39;code&#39;</span> <span class="o">=&gt;</span> <span class="nv">$code</span><span class="p">));</span></div><div class='line' id='LC715'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">}</span> <span class="k">catch</span> <span class="p">(</span><span class="nx">FacebookApiException</span> <span class="nv">$e</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC716'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="c1">// most likely that user very recently revoked authorization.</span></div><div class='line' id='LC717'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="c1">// In any event, we don&#39;t have an access token, so say so.</span></div><div class='line' id='LC718'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">return</span> <span class="k">false</span><span class="p">;</span></div><div class='line' id='LC719'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC720'><br/></div><div class='line' id='LC721'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">if</span> <span class="p">(</span><span class="k">empty</span><span class="p">(</span><span class="nv">$access_token_response</span><span class="p">))</span> <span class="p">{</span></div><div class='line' id='LC722'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">return</span> <span class="k">false</span><span class="p">;</span></div><div class='line' id='LC723'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC724'><br/></div><div class='line' id='LC725'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$response_params</span> <span class="o">=</span> <span class="k">array</span><span class="p">();</span></div><div class='line' id='LC726'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="nb">parse_str</span><span class="p">(</span><span class="nv">$access_token_response</span><span class="p">,</span> <span class="nv">$response_params</span><span class="p">);</span></div><div class='line' id='LC727'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">if</span> <span class="p">(</span><span class="o">!</span><span class="nb">isset</span><span class="p">(</span><span class="nv">$response_params</span><span class="p">[</span><span class="s1">&#39;access_token&#39;</span><span class="p">]))</span> <span class="p">{</span></div><div class='line' id='LC728'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">return</span> <span class="k">false</span><span class="p">;</span></div><div class='line' id='LC729'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC730'><br/></div><div class='line' id='LC731'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">return</span> <span class="nv">$response_params</span><span class="p">[</span><span class="s1">&#39;access_token&#39;</span><span class="p">];</span></div><div class='line' id='LC732'>&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC733'><br/></div><div class='line' id='LC734'>&nbsp;&nbsp;<span class="sd">/**</span></div><div class='line' id='LC735'><span class="sd">   * Invoke the old restserver.php endpoint.</span></div><div class='line' id='LC736'><span class="sd">   *</span></div><div class='line' id='LC737'><span class="sd">   * @param array $params Method call object</span></div><div class='line' id='LC738'><span class="sd">   *</span></div><div class='line' id='LC739'><span class="sd">   * @return mixed The decoded response object</span></div><div class='line' id='LC740'><span class="sd">   * @throws FacebookApiException</span></div><div class='line' id='LC741'><span class="sd">   */</span></div><div class='line' id='LC742'>&nbsp;&nbsp;<span class="k">protected</span> <span class="k">function</span> <span class="nf">_restserver</span><span class="p">(</span><span class="nv">$params</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC743'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="c1">// generic application level parameters</span></div><div class='line' id='LC744'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$params</span><span class="p">[</span><span class="s1">&#39;api_key&#39;</span><span class="p">]</span> <span class="o">=</span> <span class="nv">$this</span><span class="o">-&gt;</span><span class="na">getAppId</span><span class="p">();</span></div><div class='line' id='LC745'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$params</span><span class="p">[</span><span class="s1">&#39;format&#39;</span><span class="p">]</span> <span class="o">=</span> <span class="s1">&#39;json-strings&#39;</span><span class="p">;</span></div><div class='line' id='LC746'><br/></div><div class='line' id='LC747'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$result</span> <span class="o">=</span> <span class="nb">json_decode</span><span class="p">(</span><span class="nv">$this</span><span class="o">-&gt;</span><span class="na">_oauthRequest</span><span class="p">(</span></div><div class='line' id='LC748'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$this</span><span class="o">-&gt;</span><span class="na">getApiUrl</span><span class="p">(</span><span class="nv">$params</span><span class="p">[</span><span class="s1">&#39;method&#39;</span><span class="p">]),</span></div><div class='line' id='LC749'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$params</span></div><div class='line' id='LC750'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">),</span> <span class="k">true</span><span class="p">);</span></div><div class='line' id='LC751'><br/></div><div class='line' id='LC752'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="c1">// results are returned, errors are thrown</span></div><div class='line' id='LC753'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">if</span> <span class="p">(</span><span class="nb">is_array</span><span class="p">(</span><span class="nv">$result</span><span class="p">)</span> <span class="o">&amp;&amp;</span> <span class="nb">isset</span><span class="p">(</span><span class="nv">$result</span><span class="p">[</span><span class="s1">&#39;error_code&#39;</span><span class="p">]))</span> <span class="p">{</span></div><div class='line' id='LC754'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$this</span><span class="o">-&gt;</span><span class="na">throwAPIException</span><span class="p">(</span><span class="nv">$result</span><span class="p">);</span></div><div class='line' id='LC755'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC756'><br/></div><div class='line' id='LC757'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">if</span> <span class="p">(</span><span class="nv">$params</span><span class="p">[</span><span class="s1">&#39;method&#39;</span><span class="p">]</span> <span class="o">===</span> <span class="s1">&#39;auth.expireSession&#39;</span> <span class="o">||</span></div><div class='line' id='LC758'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$params</span><span class="p">[</span><span class="s1">&#39;method&#39;</span><span class="p">]</span> <span class="o">===</span> <span class="s1">&#39;auth.revokeAuthorization&#39;</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC759'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$this</span><span class="o">-&gt;</span><span class="na">destroySession</span><span class="p">();</span></div><div class='line' id='LC760'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC761'><br/></div><div class='line' id='LC762'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">return</span> <span class="nv">$result</span><span class="p">;</span></div><div class='line' id='LC763'>&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC764'><br/></div><div class='line' id='LC765'>&nbsp;&nbsp;<span class="sd">/**</span></div><div class='line' id='LC766'><span class="sd">   * Return true if this is video post.</span></div><div class='line' id='LC767'><span class="sd">   *</span></div><div class='line' id='LC768'><span class="sd">   * @param string $path The path</span></div><div class='line' id='LC769'><span class="sd">   * @param string $method The http method (default &#39;GET&#39;)</span></div><div class='line' id='LC770'><span class="sd">   *</span></div><div class='line' id='LC771'><span class="sd">   * @return boolean true if this is video post</span></div><div class='line' id='LC772'><span class="sd">   */</span></div><div class='line' id='LC773'>&nbsp;&nbsp;<span class="k">protected</span> <span class="k">function</span> <span class="nf">isVideoPost</span><span class="p">(</span><span class="nv">$path</span><span class="p">,</span> <span class="nv">$method</span> <span class="o">=</span> <span class="s1">&#39;GET&#39;</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC774'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">if</span> <span class="p">(</span><span class="nv">$method</span> <span class="o">==</span> <span class="s1">&#39;POST&#39;</span> <span class="o">&amp;&amp;</span> <span class="nb">preg_match</span><span class="p">(</span><span class="s2">&quot;/^(\/)(.+)(\/)(videos)$/&quot;</span><span class="p">,</span> <span class="nv">$path</span><span class="p">))</span> <span class="p">{</span></div><div class='line' id='LC775'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">return</span> <span class="k">true</span><span class="p">;</span></div><div class='line' id='LC776'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC777'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">return</span> <span class="k">false</span><span class="p">;</span></div><div class='line' id='LC778'>&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC779'><br/></div><div class='line' id='LC780'>&nbsp;&nbsp;<span class="sd">/**</span></div><div class='line' id='LC781'><span class="sd">   * Invoke the Graph API.</span></div><div class='line' id='LC782'><span class="sd">   *</span></div><div class='line' id='LC783'><span class="sd">   * @param string $path The path (required)</span></div><div class='line' id='LC784'><span class="sd">   * @param string $method The http method (default &#39;GET&#39;)</span></div><div class='line' id='LC785'><span class="sd">   * @param array $params The query/post data</span></div><div class='line' id='LC786'><span class="sd">   *</span></div><div class='line' id='LC787'><span class="sd">   * @return mixed The decoded response object</span></div><div class='line' id='LC788'><span class="sd">   * @throws FacebookApiException</span></div><div class='line' id='LC789'><span class="sd">   */</span></div><div class='line' id='LC790'>&nbsp;&nbsp;<span class="k">protected</span> <span class="k">function</span> <span class="nf">_graph</span><span class="p">(</span><span class="nv">$path</span><span class="p">,</span> <span class="nv">$method</span> <span class="o">=</span> <span class="s1">&#39;GET&#39;</span><span class="p">,</span> <span class="nv">$params</span> <span class="o">=</span> <span class="k">array</span><span class="p">())</span> <span class="p">{</span></div><div class='line' id='LC791'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">if</span> <span class="p">(</span><span class="nb">is_array</span><span class="p">(</span><span class="nv">$method</span><span class="p">)</span> <span class="o">&amp;&amp;</span> <span class="k">empty</span><span class="p">(</span><span class="nv">$params</span><span class="p">))</span> <span class="p">{</span></div><div class='line' id='LC792'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$params</span> <span class="o">=</span> <span class="nv">$method</span><span class="p">;</span></div><div class='line' id='LC793'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$method</span> <span class="o">=</span> <span class="s1">&#39;GET&#39;</span><span class="p">;</span></div><div class='line' id='LC794'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC795'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$params</span><span class="p">[</span><span class="s1">&#39;method&#39;</span><span class="p">]</span> <span class="o">=</span> <span class="nv">$method</span><span class="p">;</span> <span class="c1">// method override as we always do a POST</span></div><div class='line' id='LC796'><br/></div><div class='line' id='LC797'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">if</span> <span class="p">(</span><span class="nv">$this</span><span class="o">-&gt;</span><span class="na">isVideoPost</span><span class="p">(</span><span class="nv">$path</span><span class="p">,</span> <span class="nv">$method</span><span class="p">))</span> <span class="p">{</span></div><div class='line' id='LC798'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$domainKey</span> <span class="o">=</span> <span class="s1">&#39;graph_video&#39;</span><span class="p">;</span></div><div class='line' id='LC799'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">}</span> <span class="k">else</span> <span class="p">{</span></div><div class='line' id='LC800'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$domainKey</span> <span class="o">=</span> <span class="s1">&#39;graph&#39;</span><span class="p">;</span></div><div class='line' id='LC801'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC802'><br/></div><div class='line' id='LC803'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$result</span> <span class="o">=</span> <span class="nb">json_decode</span><span class="p">(</span><span class="nv">$this</span><span class="o">-&gt;</span><span class="na">_oauthRequest</span><span class="p">(</span></div><div class='line' id='LC804'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$this</span><span class="o">-&gt;</span><span class="na">getUrl</span><span class="p">(</span><span class="nv">$domainKey</span><span class="p">,</span> <span class="nv">$path</span><span class="p">),</span></div><div class='line' id='LC805'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$params</span></div><div class='line' id='LC806'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">),</span> <span class="k">true</span><span class="p">);</span></div><div class='line' id='LC807'><br/></div><div class='line' id='LC808'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="c1">// results are returned, errors are thrown</span></div><div class='line' id='LC809'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">if</span> <span class="p">(</span><span class="nb">is_array</span><span class="p">(</span><span class="nv">$result</span><span class="p">)</span> <span class="o">&amp;&amp;</span> <span class="nb">isset</span><span class="p">(</span><span class="nv">$result</span><span class="p">[</span><span class="s1">&#39;error&#39;</span><span class="p">]))</span> <span class="p">{</span></div><div class='line' id='LC810'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$this</span><span class="o">-&gt;</span><span class="na">throwAPIException</span><span class="p">(</span><span class="nv">$result</span><span class="p">);</span></div><div class='line' id='LC811'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC812'><br/></div><div class='line' id='LC813'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">return</span> <span class="nv">$result</span><span class="p">;</span></div><div class='line' id='LC814'>&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC815'><br/></div><div class='line' id='LC816'>&nbsp;&nbsp;<span class="sd">/**</span></div><div class='line' id='LC817'><span class="sd">   * Make a OAuth Request.</span></div><div class='line' id='LC818'><span class="sd">   *</span></div><div class='line' id='LC819'><span class="sd">   * @param string $url The path (required)</span></div><div class='line' id='LC820'><span class="sd">   * @param array $params The query/post data</span></div><div class='line' id='LC821'><span class="sd">   *</span></div><div class='line' id='LC822'><span class="sd">   * @return string The decoded response object</span></div><div class='line' id='LC823'><span class="sd">   * @throws FacebookApiException</span></div><div class='line' id='LC824'><span class="sd">   */</span></div><div class='line' id='LC825'>&nbsp;&nbsp;<span class="k">protected</span> <span class="k">function</span> <span class="nf">_oauthRequest</span><span class="p">(</span><span class="nv">$url</span><span class="p">,</span> <span class="nv">$params</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC826'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">if</span> <span class="p">(</span><span class="o">!</span><span class="nb">isset</span><span class="p">(</span><span class="nv">$params</span><span class="p">[</span><span class="s1">&#39;access_token&#39;</span><span class="p">]))</span> <span class="p">{</span></div><div class='line' id='LC827'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$params</span><span class="p">[</span><span class="s1">&#39;access_token&#39;</span><span class="p">]</span> <span class="o">=</span> <span class="nv">$this</span><span class="o">-&gt;</span><span class="na">getAccessToken</span><span class="p">();</span></div><div class='line' id='LC828'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC829'><br/></div><div class='line' id='LC830'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="c1">// json_encode all params values that are not strings</span></div><div class='line' id='LC831'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">foreach</span> <span class="p">(</span><span class="nv">$params</span> <span class="k">as</span> <span class="nv">$key</span> <span class="o">=&gt;</span> <span class="nv">$value</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC832'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">if</span> <span class="p">(</span><span class="o">!</span><span class="nb">is_string</span><span class="p">(</span><span class="nv">$value</span><span class="p">))</span> <span class="p">{</span></div><div class='line' id='LC833'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$params</span><span class="p">[</span><span class="nv">$key</span><span class="p">]</span> <span class="o">=</span> <span class="nb">json_encode</span><span class="p">(</span><span class="nv">$value</span><span class="p">);</span></div><div class='line' id='LC834'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC835'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC836'><br/></div><div class='line' id='LC837'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">return</span> <span class="nv">$this</span><span class="o">-&gt;</span><span class="na">makeRequest</span><span class="p">(</span><span class="nv">$url</span><span class="p">,</span> <span class="nv">$params</span><span class="p">);</span></div><div class='line' id='LC838'>&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC839'><br/></div><div class='line' id='LC840'>&nbsp;&nbsp;<span class="sd">/**</span></div><div class='line' id='LC841'><span class="sd">   * Makes an HTTP request. This method can be overridden by subclasses if</span></div><div class='line' id='LC842'><span class="sd">   * developers want to do fancier things or use something other than curl to</span></div><div class='line' id='LC843'><span class="sd">   * make the request.</span></div><div class='line' id='LC844'><span class="sd">   *</span></div><div class='line' id='LC845'><span class="sd">   * @param string $url The URL to make the request to</span></div><div class='line' id='LC846'><span class="sd">   * @param array $params The parameters to use for the POST body</span></div><div class='line' id='LC847'><span class="sd">   * @param CurlHandler $ch Initialized curl handle</span></div><div class='line' id='LC848'><span class="sd">   *</span></div><div class='line' id='LC849'><span class="sd">   * @return string The response text</span></div><div class='line' id='LC850'><span class="sd">   */</span></div><div class='line' id='LC851'>&nbsp;&nbsp;<span class="k">protected</span> <span class="k">function</span> <span class="nf">makeRequest</span><span class="p">(</span><span class="nv">$url</span><span class="p">,</span> <span class="nv">$params</span><span class="p">,</span> <span class="nv">$ch</span><span class="o">=</span><span class="k">null</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC852'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">if</span> <span class="p">(</span><span class="o">!</span><span class="nv">$ch</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC853'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$ch</span> <span class="o">=</span> <span class="nb">curl_init</span><span class="p">();</span></div><div class='line' id='LC854'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC855'><br/></div><div class='line' id='LC856'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$opts</span> <span class="o">=</span> <span class="nx">self</span><span class="o">::</span><span class="nv">$CURL_OPTS</span><span class="p">;</span></div><div class='line' id='LC857'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">if</span> <span class="p">(</span><span class="nv">$this</span><span class="o">-&gt;</span><span class="na">getFileUploadSupport</span><span class="p">())</span> <span class="p">{</span></div><div class='line' id='LC858'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$opts</span><span class="p">[</span><span class="nx">CURLOPT_POSTFIELDS</span><span class="p">]</span> <span class="o">=</span> <span class="nv">$params</span><span class="p">;</span></div><div class='line' id='LC859'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">}</span> <span class="k">else</span> <span class="p">{</span></div><div class='line' id='LC860'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$opts</span><span class="p">[</span><span class="nx">CURLOPT_POSTFIELDS</span><span class="p">]</span> <span class="o">=</span> <span class="nb">http_build_query</span><span class="p">(</span><span class="nv">$params</span><span class="p">,</span> <span class="k">null</span><span class="p">,</span> <span class="s1">&#39;&amp;&#39;</span><span class="p">);</span></div><div class='line' id='LC861'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC862'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$opts</span><span class="p">[</span><span class="nx">CURLOPT_URL</span><span class="p">]</span> <span class="o">=</span> <span class="nv">$url</span><span class="p">;</span></div><div class='line' id='LC863'><br/></div><div class='line' id='LC864'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="c1">// disable the &#39;Expect: 100-continue&#39; behaviour. This causes CURL to wait</span></div><div class='line' id='LC865'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="c1">// for 2 seconds if the server does not support this header.</span></div><div class='line' id='LC866'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">if</span> <span class="p">(</span><span class="nb">isset</span><span class="p">(</span><span class="nv">$opts</span><span class="p">[</span><span class="nx">CURLOPT_HTTPHEADER</span><span class="p">]))</span> <span class="p">{</span></div><div class='line' id='LC867'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$existing_headers</span> <span class="o">=</span> <span class="nv">$opts</span><span class="p">[</span><span class="nx">CURLOPT_HTTPHEADER</span><span class="p">];</span></div><div class='line' id='LC868'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$existing_headers</span><span class="p">[]</span> <span class="o">=</span> <span class="s1">&#39;Expect:&#39;</span><span class="p">;</span></div><div class='line' id='LC869'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$opts</span><span class="p">[</span><span class="nx">CURLOPT_HTTPHEADER</span><span class="p">]</span> <span class="o">=</span> <span class="nv">$existing_headers</span><span class="p">;</span></div><div class='line' id='LC870'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">}</span> <span class="k">else</span> <span class="p">{</span></div><div class='line' id='LC871'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$opts</span><span class="p">[</span><span class="nx">CURLOPT_HTTPHEADER</span><span class="p">]</span> <span class="o">=</span> <span class="k">array</span><span class="p">(</span><span class="s1">&#39;Expect:&#39;</span><span class="p">);</span></div><div class='line' id='LC872'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC873'><br/></div><div class='line' id='LC874'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="nb">curl_setopt_array</span><span class="p">(</span><span class="nv">$ch</span><span class="p">,</span> <span class="nv">$opts</span><span class="p">);</span></div><div class='line' id='LC875'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$result</span> <span class="o">=</span> <span class="nb">curl_exec</span><span class="p">(</span><span class="nv">$ch</span><span class="p">);</span></div><div class='line' id='LC876'><br/></div><div class='line' id='LC877'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">if</span> <span class="p">(</span><span class="nb">curl_errno</span><span class="p">(</span><span class="nv">$ch</span><span class="p">)</span> <span class="o">==</span> <span class="mi">60</span><span class="p">)</span> <span class="p">{</span> <span class="c1">// CURLE_SSL_CACERT</span></div><div class='line' id='LC878'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nx">self</span><span class="o">::</span><span class="na">errorLog</span><span class="p">(</span><span class="s1">&#39;Invalid or no certificate authority found, &#39;</span><span class="o">.</span></div><div class='line' id='LC879'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s1">&#39;using bundled information&#39;</span><span class="p">);</span></div><div class='line' id='LC880'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nb">curl_setopt</span><span class="p">(</span><span class="nv">$ch</span><span class="p">,</span> <span class="nx">CURLOPT_CAINFO</span><span class="p">,</span></div><div class='line' id='LC881'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nb">dirname</span><span class="p">(</span><span class="k">__FILE__</span><span class="p">)</span> <span class="o">.</span> <span class="s1">&#39;/fb_ca_chain_bundle.crt&#39;</span><span class="p">);</span></div><div class='line' id='LC882'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$result</span> <span class="o">=</span> <span class="nb">curl_exec</span><span class="p">(</span><span class="nv">$ch</span><span class="p">);</span></div><div class='line' id='LC883'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC884'><br/></div><div class='line' id='LC885'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">if</span> <span class="p">(</span><span class="nv">$result</span> <span class="o">===</span> <span class="k">false</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC886'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$e</span> <span class="o">=</span> <span class="k">new</span> <span class="nx">FacebookApiException</span><span class="p">(</span><span class="k">array</span><span class="p">(</span></div><div class='line' id='LC887'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s1">&#39;error_code&#39;</span> <span class="o">=&gt;</span> <span class="nb">curl_errno</span><span class="p">(</span><span class="nv">$ch</span><span class="p">),</span></div><div class='line' id='LC888'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s1">&#39;error&#39;</span> <span class="o">=&gt;</span> <span class="k">array</span><span class="p">(</span></div><div class='line' id='LC889'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s1">&#39;message&#39;</span> <span class="o">=&gt;</span> <span class="nb">curl_error</span><span class="p">(</span><span class="nv">$ch</span><span class="p">),</span></div><div class='line' id='LC890'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s1">&#39;type&#39;</span> <span class="o">=&gt;</span> <span class="s1">&#39;CurlException&#39;</span><span class="p">,</span></div><div class='line' id='LC891'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">),</span></div><div class='line' id='LC892'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">));</span></div><div class='line' id='LC893'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nb">curl_close</span><span class="p">(</span><span class="nv">$ch</span><span class="p">);</span></div><div class='line' id='LC894'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">throw</span> <span class="nv">$e</span><span class="p">;</span></div><div class='line' id='LC895'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC896'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="nb">curl_close</span><span class="p">(</span><span class="nv">$ch</span><span class="p">);</span></div><div class='line' id='LC897'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">return</span> <span class="nv">$result</span><span class="p">;</span></div><div class='line' id='LC898'>&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC899'><br/></div><div class='line' id='LC900'>&nbsp;&nbsp;<span class="sd">/**</span></div><div class='line' id='LC901'><span class="sd">   * Parses a signed_request and validates the signature.</span></div><div class='line' id='LC902'><span class="sd">   *</span></div><div class='line' id='LC903'><span class="sd">   * @param string $signed_request A signed token</span></div><div class='line' id='LC904'><span class="sd">   * @return array The payload inside it or null if the sig is wrong</span></div><div class='line' id='LC905'><span class="sd">   */</span></div><div class='line' id='LC906'>&nbsp;&nbsp;<span class="k">protected</span> <span class="k">function</span> <span class="nf">parseSignedRequest</span><span class="p">(</span><span class="nv">$signed_request</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC907'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">list</span><span class="p">(</span><span class="nv">$encoded_sig</span><span class="p">,</span> <span class="nv">$payload</span><span class="p">)</span> <span class="o">=</span> <span class="nb">explode</span><span class="p">(</span><span class="s1">&#39;.&#39;</span><span class="p">,</span> <span class="nv">$signed_request</span><span class="p">,</span> <span class="mi">2</span><span class="p">);</span></div><div class='line' id='LC908'><br/></div><div class='line' id='LC909'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="c1">// decode the data</span></div><div class='line' id='LC910'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$sig</span> <span class="o">=</span> <span class="nx">self</span><span class="o">::</span><span class="na">base64UrlDecode</span><span class="p">(</span><span class="nv">$encoded_sig</span><span class="p">);</span></div><div class='line' id='LC911'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$data</span> <span class="o">=</span> <span class="nb">json_decode</span><span class="p">(</span><span class="nx">self</span><span class="o">::</span><span class="na">base64UrlDecode</span><span class="p">(</span><span class="nv">$payload</span><span class="p">),</span> <span class="k">true</span><span class="p">);</span></div><div class='line' id='LC912'><br/></div><div class='line' id='LC913'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">if</span> <span class="p">(</span><span class="nx">strtoupper</span><span class="p">(</span><span class="nv">$data</span><span class="p">[</span><span class="s1">&#39;algorithm&#39;</span><span class="p">])</span> <span class="o">!==</span> <span class="s1">&#39;HMAC-SHA256&#39;</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC914'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nx">self</span><span class="o">::</span><span class="na">errorLog</span><span class="p">(</span><span class="s1">&#39;Unknown algorithm. Expected HMAC-SHA256&#39;</span><span class="p">);</span></div><div class='line' id='LC915'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">return</span> <span class="k">null</span><span class="p">;</span></div><div class='line' id='LC916'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC917'><br/></div><div class='line' id='LC918'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="c1">// check sig</span></div><div class='line' id='LC919'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$expected_sig</span> <span class="o">=</span> <span class="nb">hash_hmac</span><span class="p">(</span><span class="s1">&#39;sha256&#39;</span><span class="p">,</span> <span class="nv">$payload</span><span class="p">,</span></div><div class='line' id='LC920'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$this</span><span class="o">-&gt;</span><span class="na">getAppSecret</span><span class="p">(),</span> <span class="nv">$raw</span> <span class="o">=</span> <span class="k">true</span><span class="p">);</span></div><div class='line' id='LC921'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">if</span> <span class="p">(</span><span class="nv">$sig</span> <span class="o">!==</span> <span class="nv">$expected_sig</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC922'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nx">self</span><span class="o">::</span><span class="na">errorLog</span><span class="p">(</span><span class="s1">&#39;Bad Signed JSON signature!&#39;</span><span class="p">);</span></div><div class='line' id='LC923'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">return</span> <span class="k">null</span><span class="p">;</span></div><div class='line' id='LC924'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC925'><br/></div><div class='line' id='LC926'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">return</span> <span class="nv">$data</span><span class="p">;</span></div><div class='line' id='LC927'>&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC928'><br/></div><div class='line' id='LC929'>&nbsp;&nbsp;<span class="sd">/**</span></div><div class='line' id='LC930'><span class="sd">   * Build the URL for api given parameters.</span></div><div class='line' id='LC931'><span class="sd">   *</span></div><div class='line' id='LC932'><span class="sd">   * @param $method String the method name.</span></div><div class='line' id='LC933'><span class="sd">   * @return string The URL for the given parameters</span></div><div class='line' id='LC934'><span class="sd">   */</span></div><div class='line' id='LC935'>&nbsp;&nbsp;<span class="k">protected</span> <span class="k">function</span> <span class="nf">getApiUrl</span><span class="p">(</span><span class="nv">$method</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC936'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">static</span> <span class="nv">$READ_ONLY_CALLS</span> <span class="o">=</span></div><div class='line' id='LC937'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">array</span><span class="p">(</span><span class="s1">&#39;admin.getallocation&#39;</span> <span class="o">=&gt;</span> <span class="mi">1</span><span class="p">,</span></div><div class='line' id='LC938'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s1">&#39;admin.getappproperties&#39;</span> <span class="o">=&gt;</span> <span class="mi">1</span><span class="p">,</span></div><div class='line' id='LC939'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s1">&#39;admin.getbannedusers&#39;</span> <span class="o">=&gt;</span> <span class="mi">1</span><span class="p">,</span></div><div class='line' id='LC940'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s1">&#39;admin.getlivestreamvialink&#39;</span> <span class="o">=&gt;</span> <span class="mi">1</span><span class="p">,</span></div><div class='line' id='LC941'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s1">&#39;admin.getmetrics&#39;</span> <span class="o">=&gt;</span> <span class="mi">1</span><span class="p">,</span></div><div class='line' id='LC942'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s1">&#39;admin.getrestrictioninfo&#39;</span> <span class="o">=&gt;</span> <span class="mi">1</span><span class="p">,</span></div><div class='line' id='LC943'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s1">&#39;application.getpublicinfo&#39;</span> <span class="o">=&gt;</span> <span class="mi">1</span><span class="p">,</span></div><div class='line' id='LC944'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s1">&#39;auth.getapppublickey&#39;</span> <span class="o">=&gt;</span> <span class="mi">1</span><span class="p">,</span></div><div class='line' id='LC945'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s1">&#39;auth.getsession&#39;</span> <span class="o">=&gt;</span> <span class="mi">1</span><span class="p">,</span></div><div class='line' id='LC946'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s1">&#39;auth.getsignedpublicsessiondata&#39;</span> <span class="o">=&gt;</span> <span class="mi">1</span><span class="p">,</span></div><div class='line' id='LC947'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s1">&#39;comments.get&#39;</span> <span class="o">=&gt;</span> <span class="mi">1</span><span class="p">,</span></div><div class='line' id='LC948'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s1">&#39;connect.getunconnectedfriendscount&#39;</span> <span class="o">=&gt;</span> <span class="mi">1</span><span class="p">,</span></div><div class='line' id='LC949'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s1">&#39;dashboard.getactivity&#39;</span> <span class="o">=&gt;</span> <span class="mi">1</span><span class="p">,</span></div><div class='line' id='LC950'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s1">&#39;dashboard.getcount&#39;</span> <span class="o">=&gt;</span> <span class="mi">1</span><span class="p">,</span></div><div class='line' id='LC951'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s1">&#39;dashboard.getglobalnews&#39;</span> <span class="o">=&gt;</span> <span class="mi">1</span><span class="p">,</span></div><div class='line' id='LC952'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s1">&#39;dashboard.getnews&#39;</span> <span class="o">=&gt;</span> <span class="mi">1</span><span class="p">,</span></div><div class='line' id='LC953'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s1">&#39;dashboard.multigetcount&#39;</span> <span class="o">=&gt;</span> <span class="mi">1</span><span class="p">,</span></div><div class='line' id='LC954'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s1">&#39;dashboard.multigetnews&#39;</span> <span class="o">=&gt;</span> <span class="mi">1</span><span class="p">,</span></div><div class='line' id='LC955'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s1">&#39;data.getcookies&#39;</span> <span class="o">=&gt;</span> <span class="mi">1</span><span class="p">,</span></div><div class='line' id='LC956'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s1">&#39;events.get&#39;</span> <span class="o">=&gt;</span> <span class="mi">1</span><span class="p">,</span></div><div class='line' id='LC957'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s1">&#39;events.getmembers&#39;</span> <span class="o">=&gt;</span> <span class="mi">1</span><span class="p">,</span></div><div class='line' id='LC958'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s1">&#39;fbml.getcustomtags&#39;</span> <span class="o">=&gt;</span> <span class="mi">1</span><span class="p">,</span></div><div class='line' id='LC959'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s1">&#39;feed.getappfriendstories&#39;</span> <span class="o">=&gt;</span> <span class="mi">1</span><span class="p">,</span></div><div class='line' id='LC960'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s1">&#39;feed.getregisteredtemplatebundlebyid&#39;</span> <span class="o">=&gt;</span> <span class="mi">1</span><span class="p">,</span></div><div class='line' id='LC961'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s1">&#39;feed.getregisteredtemplatebundles&#39;</span> <span class="o">=&gt;</span> <span class="mi">1</span><span class="p">,</span></div><div class='line' id='LC962'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s1">&#39;fql.multiquery&#39;</span> <span class="o">=&gt;</span> <span class="mi">1</span><span class="p">,</span></div><div class='line' id='LC963'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s1">&#39;fql.query&#39;</span> <span class="o">=&gt;</span> <span class="mi">1</span><span class="p">,</span></div><div class='line' id='LC964'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s1">&#39;friends.arefriends&#39;</span> <span class="o">=&gt;</span> <span class="mi">1</span><span class="p">,</span></div><div class='line' id='LC965'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s1">&#39;friends.get&#39;</span> <span class="o">=&gt;</span> <span class="mi">1</span><span class="p">,</span></div><div class='line' id='LC966'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s1">&#39;friends.getappusers&#39;</span> <span class="o">=&gt;</span> <span class="mi">1</span><span class="p">,</span></div><div class='line' id='LC967'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s1">&#39;friends.getlists&#39;</span> <span class="o">=&gt;</span> <span class="mi">1</span><span class="p">,</span></div><div class='line' id='LC968'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s1">&#39;friends.getmutualfriends&#39;</span> <span class="o">=&gt;</span> <span class="mi">1</span><span class="p">,</span></div><div class='line' id='LC969'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s1">&#39;gifts.get&#39;</span> <span class="o">=&gt;</span> <span class="mi">1</span><span class="p">,</span></div><div class='line' id='LC970'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s1">&#39;groups.get&#39;</span> <span class="o">=&gt;</span> <span class="mi">1</span><span class="p">,</span></div><div class='line' id='LC971'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s1">&#39;groups.getmembers&#39;</span> <span class="o">=&gt;</span> <span class="mi">1</span><span class="p">,</span></div><div class='line' id='LC972'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s1">&#39;intl.gettranslations&#39;</span> <span class="o">=&gt;</span> <span class="mi">1</span><span class="p">,</span></div><div class='line' id='LC973'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s1">&#39;links.get&#39;</span> <span class="o">=&gt;</span> <span class="mi">1</span><span class="p">,</span></div><div class='line' id='LC974'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s1">&#39;notes.get&#39;</span> <span class="o">=&gt;</span> <span class="mi">1</span><span class="p">,</span></div><div class='line' id='LC975'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s1">&#39;notifications.get&#39;</span> <span class="o">=&gt;</span> <span class="mi">1</span><span class="p">,</span></div><div class='line' id='LC976'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s1">&#39;pages.getinfo&#39;</span> <span class="o">=&gt;</span> <span class="mi">1</span><span class="p">,</span></div><div class='line' id='LC977'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s1">&#39;pages.isadmin&#39;</span> <span class="o">=&gt;</span> <span class="mi">1</span><span class="p">,</span></div><div class='line' id='LC978'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s1">&#39;pages.isappadded&#39;</span> <span class="o">=&gt;</span> <span class="mi">1</span><span class="p">,</span></div><div class='line' id='LC979'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s1">&#39;pages.isfan&#39;</span> <span class="o">=&gt;</span> <span class="mi">1</span><span class="p">,</span></div><div class='line' id='LC980'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s1">&#39;permissions.checkavailableapiaccess&#39;</span> <span class="o">=&gt;</span> <span class="mi">1</span><span class="p">,</span></div><div class='line' id='LC981'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s1">&#39;permissions.checkgrantedapiaccess&#39;</span> <span class="o">=&gt;</span> <span class="mi">1</span><span class="p">,</span></div><div class='line' id='LC982'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s1">&#39;photos.get&#39;</span> <span class="o">=&gt;</span> <span class="mi">1</span><span class="p">,</span></div><div class='line' id='LC983'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s1">&#39;photos.getalbums&#39;</span> <span class="o">=&gt;</span> <span class="mi">1</span><span class="p">,</span></div><div class='line' id='LC984'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s1">&#39;photos.gettags&#39;</span> <span class="o">=&gt;</span> <span class="mi">1</span><span class="p">,</span></div><div class='line' id='LC985'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s1">&#39;profile.getinfo&#39;</span> <span class="o">=&gt;</span> <span class="mi">1</span><span class="p">,</span></div><div class='line' id='LC986'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s1">&#39;profile.getinfooptions&#39;</span> <span class="o">=&gt;</span> <span class="mi">1</span><span class="p">,</span></div><div class='line' id='LC987'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s1">&#39;stream.get&#39;</span> <span class="o">=&gt;</span> <span class="mi">1</span><span class="p">,</span></div><div class='line' id='LC988'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s1">&#39;stream.getcomments&#39;</span> <span class="o">=&gt;</span> <span class="mi">1</span><span class="p">,</span></div><div class='line' id='LC989'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s1">&#39;stream.getfilters&#39;</span> <span class="o">=&gt;</span> <span class="mi">1</span><span class="p">,</span></div><div class='line' id='LC990'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s1">&#39;users.getinfo&#39;</span> <span class="o">=&gt;</span> <span class="mi">1</span><span class="p">,</span></div><div class='line' id='LC991'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s1">&#39;users.getloggedinuser&#39;</span> <span class="o">=&gt;</span> <span class="mi">1</span><span class="p">,</span></div><div class='line' id='LC992'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s1">&#39;users.getstandardinfo&#39;</span> <span class="o">=&gt;</span> <span class="mi">1</span><span class="p">,</span></div><div class='line' id='LC993'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s1">&#39;users.hasapppermission&#39;</span> <span class="o">=&gt;</span> <span class="mi">1</span><span class="p">,</span></div><div class='line' id='LC994'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s1">&#39;users.isappuser&#39;</span> <span class="o">=&gt;</span> <span class="mi">1</span><span class="p">,</span></div><div class='line' id='LC995'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s1">&#39;users.isverified&#39;</span> <span class="o">=&gt;</span> <span class="mi">1</span><span class="p">,</span></div><div class='line' id='LC996'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s1">&#39;video.getuploadlimits&#39;</span> <span class="o">=&gt;</span> <span class="mi">1</span><span class="p">);</span></div><div class='line' id='LC997'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$name</span> <span class="o">=</span> <span class="s1">&#39;api&#39;</span><span class="p">;</span></div><div class='line' id='LC998'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">if</span> <span class="p">(</span><span class="nb">isset</span><span class="p">(</span><span class="nv">$READ_ONLY_CALLS</span><span class="p">[</span><span class="nx">strtolower</span><span class="p">(</span><span class="nv">$method</span><span class="p">)]))</span> <span class="p">{</span></div><div class='line' id='LC999'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$name</span> <span class="o">=</span> <span class="s1">&#39;api_read&#39;</span><span class="p">;</span></div><div class='line' id='LC1000'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">}</span> <span class="k">else</span> <span class="k">if</span> <span class="p">(</span><span class="nx">strtolower</span><span class="p">(</span><span class="nv">$method</span><span class="p">)</span> <span class="o">==</span> <span class="s1">&#39;video.upload&#39;</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC1001'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$name</span> <span class="o">=</span> <span class="s1">&#39;api_video&#39;</span><span class="p">;</span></div><div class='line' id='LC1002'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC1003'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">return</span> <span class="nx">self</span><span class="o">::</span><span class="na">getUrl</span><span class="p">(</span><span class="nv">$name</span><span class="p">,</span> <span class="s1">&#39;restserver.php&#39;</span><span class="p">);</span></div><div class='line' id='LC1004'>&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC1005'><br/></div><div class='line' id='LC1006'>&nbsp;&nbsp;<span class="sd">/**</span></div><div class='line' id='LC1007'><span class="sd">   * Build the URL for given domain alias, path and parameters.</span></div><div class='line' id='LC1008'><span class="sd">   *</span></div><div class='line' id='LC1009'><span class="sd">   * @param $name string The name of the domain</span></div><div class='line' id='LC1010'><span class="sd">   * @param $path string Optional path (without a leading slash)</span></div><div class='line' id='LC1011'><span class="sd">   * @param $params array Optional query parameters</span></div><div class='line' id='LC1012'><span class="sd">   *</span></div><div class='line' id='LC1013'><span class="sd">   * @return string The URL for the given parameters</span></div><div class='line' id='LC1014'><span class="sd">   */</span></div><div class='line' id='LC1015'>&nbsp;&nbsp;<span class="k">protected</span> <span class="k">function</span> <span class="nf">getUrl</span><span class="p">(</span><span class="nv">$name</span><span class="p">,</span> <span class="nv">$path</span><span class="o">=</span><span class="s1">&#39;&#39;</span><span class="p">,</span> <span class="nv">$params</span><span class="o">=</span><span class="k">array</span><span class="p">())</span> <span class="p">{</span></div><div class='line' id='LC1016'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$url</span> <span class="o">=</span> <span class="nx">self</span><span class="o">::</span><span class="nv">$DOMAIN_MAP</span><span class="p">[</span><span class="nv">$name</span><span class="p">];</span></div><div class='line' id='LC1017'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">if</span> <span class="p">(</span><span class="nv">$path</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC1018'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">if</span> <span class="p">(</span><span class="nv">$path</span><span class="p">[</span><span class="mi">0</span><span class="p">]</span> <span class="o">===</span> <span class="s1">&#39;/&#39;</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC1019'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$path</span> <span class="o">=</span> <span class="nx">substr</span><span class="p">(</span><span class="nv">$path</span><span class="p">,</span> <span class="mi">1</span><span class="p">);</span></div><div class='line' id='LC1020'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC1021'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$url</span> <span class="o">.=</span> <span class="nv">$path</span><span class="p">;</span></div><div class='line' id='LC1022'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC1023'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">if</span> <span class="p">(</span><span class="nv">$params</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC1024'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$url</span> <span class="o">.=</span> <span class="s1">&#39;?&#39;</span> <span class="o">.</span> <span class="nb">http_build_query</span><span class="p">(</span><span class="nv">$params</span><span class="p">,</span> <span class="k">null</span><span class="p">,</span> <span class="s1">&#39;&amp;&#39;</span><span class="p">);</span></div><div class='line' id='LC1025'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC1026'><br/></div><div class='line' id='LC1027'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">return</span> <span class="nv">$url</span><span class="p">;</span></div><div class='line' id='LC1028'>&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC1029'><br/></div><div class='line' id='LC1030'>&nbsp;&nbsp;<span class="sd">/**</span></div><div class='line' id='LC1031'><span class="sd">   * Returns the Current URL, stripping it of known FB parameters that should</span></div><div class='line' id='LC1032'><span class="sd">   * not persist.</span></div><div class='line' id='LC1033'><span class="sd">   *</span></div><div class='line' id='LC1034'><span class="sd">   * @return string The current URL</span></div><div class='line' id='LC1035'><span class="sd">   */</span></div><div class='line' id='LC1036'>&nbsp;&nbsp;<span class="k">protected</span> <span class="k">function</span> <span class="nf">getCurrentUrl</span><span class="p">()</span> <span class="p">{</span></div><div class='line' id='LC1037'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">if</span> <span class="p">(</span><span class="nb">isset</span><span class="p">(</span><span class="nv">$_SERVER</span><span class="p">[</span><span class="s1">&#39;HTTPS&#39;</span><span class="p">])</span> <span class="o">&amp;&amp;</span></div><div class='line' id='LC1038'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">(</span><span class="nv">$_SERVER</span><span class="p">[</span><span class="s1">&#39;HTTPS&#39;</span><span class="p">]</span> <span class="o">==</span> <span class="s1">&#39;on&#39;</span> <span class="o">||</span> <span class="nv">$_SERVER</span><span class="p">[</span><span class="s1">&#39;HTTPS&#39;</span><span class="p">]</span> <span class="o">==</span> <span class="mi">1</span><span class="p">)</span> <span class="o">||</span></div><div class='line' id='LC1039'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nb">isset</span><span class="p">(</span><span class="nv">$_SERVER</span><span class="p">[</span><span class="s1">&#39;HTTP_X_FORWARDED_PROTO&#39;</span><span class="p">])</span> <span class="o">&amp;&amp;</span></div><div class='line' id='LC1040'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$_SERVER</span><span class="p">[</span><span class="s1">&#39;HTTP_X_FORWARDED_PROTO&#39;</span><span class="p">]</span> <span class="o">==</span> <span class="s1">&#39;https&#39;</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC1041'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$protocol</span> <span class="o">=</span> <span class="s1">&#39;https://&#39;</span><span class="p">;</span></div><div class='line' id='LC1042'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC1043'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">else</span> <span class="p">{</span></div><div class='line' id='LC1044'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$protocol</span> <span class="o">=</span> <span class="s1">&#39;http://&#39;</span><span class="p">;</span></div><div class='line' id='LC1045'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC1046'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$currentUrl</span> <span class="o">=</span> <span class="nv">$protocol</span> <span class="o">.</span> <span class="nv">$_SERVER</span><span class="p">[</span><span class="s1">&#39;HTTP_HOST&#39;</span><span class="p">]</span> <span class="o">.</span> <span class="nv">$_SERVER</span><span class="p">[</span><span class="s1">&#39;REQUEST_URI&#39;</span><span class="p">];</span></div><div class='line' id='LC1047'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$parts</span> <span class="o">=</span> <span class="nb">parse_url</span><span class="p">(</span><span class="nv">$currentUrl</span><span class="p">);</span></div><div class='line' id='LC1048'><br/></div><div class='line' id='LC1049'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$query</span> <span class="o">=</span> <span class="s1">&#39;&#39;</span><span class="p">;</span></div><div class='line' id='LC1050'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">if</span> <span class="p">(</span><span class="o">!</span><span class="k">empty</span><span class="p">(</span><span class="nv">$parts</span><span class="p">[</span><span class="s1">&#39;query&#39;</span><span class="p">]))</span> <span class="p">{</span></div><div class='line' id='LC1051'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="c1">// drop known fb params</span></div><div class='line' id='LC1052'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$params</span> <span class="o">=</span> <span class="nb">explode</span><span class="p">(</span><span class="s1">&#39;&amp;&#39;</span><span class="p">,</span> <span class="nv">$parts</span><span class="p">[</span><span class="s1">&#39;query&#39;</span><span class="p">]);</span></div><div class='line' id='LC1053'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$retained_params</span> <span class="o">=</span> <span class="k">array</span><span class="p">();</span></div><div class='line' id='LC1054'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">foreach</span> <span class="p">(</span><span class="nv">$params</span> <span class="k">as</span> <span class="nv">$param</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC1055'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">if</span> <span class="p">(</span><span class="nv">$this</span><span class="o">-&gt;</span><span class="na">shouldRetainParam</span><span class="p">(</span><span class="nv">$param</span><span class="p">))</span> <span class="p">{</span></div><div class='line' id='LC1056'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$retained_params</span><span class="p">[]</span> <span class="o">=</span> <span class="nv">$param</span><span class="p">;</span></div><div class='line' id='LC1057'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC1058'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC1059'><br/></div><div class='line' id='LC1060'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">if</span> <span class="p">(</span><span class="o">!</span><span class="k">empty</span><span class="p">(</span><span class="nv">$retained_params</span><span class="p">))</span> <span class="p">{</span></div><div class='line' id='LC1061'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$query</span> <span class="o">=</span> <span class="s1">&#39;?&#39;</span><span class="o">.</span><span class="nb">implode</span><span class="p">(</span><span class="nv">$retained_params</span><span class="p">,</span> <span class="s1">&#39;&amp;&#39;</span><span class="p">);</span></div><div class='line' id='LC1062'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC1063'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC1064'><br/></div><div class='line' id='LC1065'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="c1">// use port if non default</span></div><div class='line' id='LC1066'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$port</span> <span class="o">=</span></div><div class='line' id='LC1067'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nb">isset</span><span class="p">(</span><span class="nv">$parts</span><span class="p">[</span><span class="s1">&#39;port&#39;</span><span class="p">])</span> <span class="o">&amp;&amp;</span></div><div class='line' id='LC1068'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">((</span><span class="nv">$protocol</span> <span class="o">===</span> <span class="s1">&#39;http://&#39;</span> <span class="o">&amp;&amp;</span> <span class="nv">$parts</span><span class="p">[</span><span class="s1">&#39;port&#39;</span><span class="p">]</span> <span class="o">!==</span> <span class="mi">80</span><span class="p">)</span> <span class="o">||</span></div><div class='line' id='LC1069'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">(</span><span class="nv">$protocol</span> <span class="o">===</span> <span class="s1">&#39;https://&#39;</span> <span class="o">&amp;&amp;</span> <span class="nv">$parts</span><span class="p">[</span><span class="s1">&#39;port&#39;</span><span class="p">]</span> <span class="o">!==</span> <span class="mi">443</span><span class="p">))</span></div><div class='line' id='LC1070'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="o">?</span> <span class="s1">&#39;:&#39;</span> <span class="o">.</span> <span class="nv">$parts</span><span class="p">[</span><span class="s1">&#39;port&#39;</span><span class="p">]</span> <span class="o">:</span> <span class="s1">&#39;&#39;</span><span class="p">;</span></div><div class='line' id='LC1071'><br/></div><div class='line' id='LC1072'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="c1">// rebuild</span></div><div class='line' id='LC1073'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">return</span> <span class="nv">$protocol</span> <span class="o">.</span> <span class="nv">$parts</span><span class="p">[</span><span class="s1">&#39;host&#39;</span><span class="p">]</span> <span class="o">.</span> <span class="nv">$port</span> <span class="o">.</span> <span class="nv">$parts</span><span class="p">[</span><span class="s1">&#39;path&#39;</span><span class="p">]</span> <span class="o">.</span> <span class="nv">$query</span><span class="p">;</span></div><div class='line' id='LC1074'>&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC1075'><br/></div><div class='line' id='LC1076'>&nbsp;&nbsp;<span class="sd">/**</span></div><div class='line' id='LC1077'><span class="sd">   * Returns true if and only if the key or key/value pair should</span></div><div class='line' id='LC1078'><span class="sd">   * be retained as part of the query string.  This amounts to</span></div><div class='line' id='LC1079'><span class="sd">   * a brute-force search of the very small list of Facebook-specific</span></div><div class='line' id='LC1080'><span class="sd">   * params that should be stripped out.</span></div><div class='line' id='LC1081'><span class="sd">   *</span></div><div class='line' id='LC1082'><span class="sd">   * @param string $param A key or key/value pair within a URL&#39;s query (e.g.</span></div><div class='line' id='LC1083'><span class="sd">   *                     &#39;foo=a&#39;, &#39;foo=&#39;, or &#39;foo&#39;.</span></div><div class='line' id='LC1084'><span class="sd">   *</span></div><div class='line' id='LC1085'><span class="sd">   * @return boolean</span></div><div class='line' id='LC1086'><span class="sd">   */</span></div><div class='line' id='LC1087'>&nbsp;&nbsp;<span class="k">protected</span> <span class="k">function</span> <span class="nf">shouldRetainParam</span><span class="p">(</span><span class="nv">$param</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC1088'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">foreach</span> <span class="p">(</span><span class="nx">self</span><span class="o">::</span><span class="nv">$DROP_QUERY_PARAMS</span> <span class="k">as</span> <span class="nv">$drop_query_param</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC1089'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">if</span> <span class="p">(</span><span class="nb">strpos</span><span class="p">(</span><span class="nv">$param</span><span class="p">,</span> <span class="nv">$drop_query_param</span><span class="o">.</span><span class="s1">&#39;=&#39;</span><span class="p">)</span> <span class="o">===</span> <span class="mi">0</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC1090'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">return</span> <span class="k">false</span><span class="p">;</span></div><div class='line' id='LC1091'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC1092'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC1093'><br/></div><div class='line' id='LC1094'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">return</span> <span class="k">true</span><span class="p">;</span></div><div class='line' id='LC1095'>&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC1096'><br/></div><div class='line' id='LC1097'>&nbsp;&nbsp;<span class="sd">/**</span></div><div class='line' id='LC1098'><span class="sd">   * Analyzes the supplied result to see if it was thrown</span></div><div class='line' id='LC1099'><span class="sd">   * because the access token is no longer valid.  If that is</span></div><div class='line' id='LC1100'><span class="sd">   * the case, then we destroy the session.</span></div><div class='line' id='LC1101'><span class="sd">   *</span></div><div class='line' id='LC1102'><span class="sd">   * @param $result array A record storing the error message returned</span></div><div class='line' id='LC1103'><span class="sd">   *                      by a failed API call.</span></div><div class='line' id='LC1104'><span class="sd">   */</span></div><div class='line' id='LC1105'>&nbsp;&nbsp;<span class="k">protected</span> <span class="k">function</span> <span class="nf">throwAPIException</span><span class="p">(</span><span class="nv">$result</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC1106'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$e</span> <span class="o">=</span> <span class="k">new</span> <span class="nx">FacebookApiException</span><span class="p">(</span><span class="nv">$result</span><span class="p">);</span></div><div class='line' id='LC1107'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">switch</span> <span class="p">(</span><span class="nv">$e</span><span class="o">-&gt;</span><span class="na">getType</span><span class="p">())</span> <span class="p">{</span></div><div class='line' id='LC1108'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="c1">// OAuth 2.0 Draft 00 style</span></div><div class='line' id='LC1109'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">case</span> <span class="s1">&#39;OAuthException&#39;</span><span class="o">:</span></div><div class='line' id='LC1110'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="c1">// OAuth 2.0 Draft 10 style</span></div><div class='line' id='LC1111'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">case</span> <span class="s1">&#39;invalid_token&#39;</span><span class="o">:</span></div><div class='line' id='LC1112'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="c1">// REST server errors are just Exceptions</span></div><div class='line' id='LC1113'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">case</span> <span class="s1">&#39;Exception&#39;</span><span class="o">:</span></div><div class='line' id='LC1114'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$message</span> <span class="o">=</span> <span class="nv">$e</span><span class="o">-&gt;</span><span class="na">getMessage</span><span class="p">();</span></div><div class='line' id='LC1115'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">if</span> <span class="p">((</span><span class="nb">strpos</span><span class="p">(</span><span class="nv">$message</span><span class="p">,</span> <span class="s1">&#39;Error validating access token&#39;</span><span class="p">)</span> <span class="o">!==</span> <span class="k">false</span><span class="p">)</span> <span class="o">||</span></div><div class='line' id='LC1116'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">(</span><span class="nb">strpos</span><span class="p">(</span><span class="nv">$message</span><span class="p">,</span> <span class="s1">&#39;Invalid OAuth access token&#39;</span><span class="p">)</span> <span class="o">!==</span> <span class="k">false</span><span class="p">)</span> <span class="o">||</span></div><div class='line' id='LC1117'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">(</span><span class="nb">strpos</span><span class="p">(</span><span class="nv">$message</span><span class="p">,</span> <span class="s1">&#39;An active access token must be used&#39;</span><span class="p">)</span> <span class="o">!==</span> <span class="k">false</span><span class="p">)</span></div><div class='line' id='LC1118'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC1119'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$this</span><span class="o">-&gt;</span><span class="na">destroySession</span><span class="p">();</span></div><div class='line' id='LC1120'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC1121'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">break</span><span class="p">;</span></div><div class='line' id='LC1122'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC1123'><br/></div><div class='line' id='LC1124'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">throw</span> <span class="nv">$e</span><span class="p">;</span></div><div class='line' id='LC1125'>&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC1126'><br/></div><div class='line' id='LC1127'><br/></div><div class='line' id='LC1128'>&nbsp;&nbsp;<span class="sd">/**</span></div><div class='line' id='LC1129'><span class="sd">   * Prints to the error log if you aren&#39;t in command line mode.</span></div><div class='line' id='LC1130'><span class="sd">   *</span></div><div class='line' id='LC1131'><span class="sd">   * @param string $msg Log message</span></div><div class='line' id='LC1132'><span class="sd">   */</span></div><div class='line' id='LC1133'>&nbsp;&nbsp;<span class="k">protected</span> <span class="k">static</span> <span class="k">function</span> <span class="nf">errorLog</span><span class="p">(</span><span class="nv">$msg</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC1134'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="c1">// disable error log if we are running in a CLI environment</span></div><div class='line' id='LC1135'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="c1">// @codeCoverageIgnoreStart</span></div><div class='line' id='LC1136'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">if</span> <span class="p">(</span><span class="nb">php_sapi_name</span><span class="p">()</span> <span class="o">!=</span> <span class="s1">&#39;cli&#39;</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC1137'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nb">error_log</span><span class="p">(</span><span class="nv">$msg</span><span class="p">);</span></div><div class='line' id='LC1138'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC1139'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="c1">// uncomment this if you want to see the errors on the page</span></div><div class='line' id='LC1140'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="c1">// print &#39;error_log: &#39;.$msg.&quot;\n&quot;;</span></div><div class='line' id='LC1141'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="c1">// @codeCoverageIgnoreEnd</span></div><div class='line' id='LC1142'>&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC1143'><br/></div><div class='line' id='LC1144'>&nbsp;&nbsp;<span class="sd">/**</span></div><div class='line' id='LC1145'><span class="sd">   * Base64 encoding that doesn&#39;t need to be urlencode()ed.</span></div><div class='line' id='LC1146'><span class="sd">   * Exactly the same as base64_encode except it uses</span></div><div class='line' id='LC1147'><span class="sd">   *   - instead of +</span></div><div class='line' id='LC1148'><span class="sd">   *   _ instead of /</span></div><div class='line' id='LC1149'><span class="sd">   *</span></div><div class='line' id='LC1150'><span class="sd">   * @param string $input base64UrlEncoded string</span></div><div class='line' id='LC1151'><span class="sd">   * @return string</span></div><div class='line' id='LC1152'><span class="sd">   */</span></div><div class='line' id='LC1153'>&nbsp;&nbsp;<span class="k">protected</span> <span class="k">static</span> <span class="k">function</span> <span class="nf">base64UrlDecode</span><span class="p">(</span><span class="nv">$input</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC1154'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">return</span> <span class="nb">base64_decode</span><span class="p">(</span><span class="nx">strtr</span><span class="p">(</span><span class="nv">$input</span><span class="p">,</span> <span class="s1">&#39;-_&#39;</span><span class="p">,</span> <span class="s1">&#39;+/&#39;</span><span class="p">));</span></div><div class='line' id='LC1155'>&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC1156'><br/></div><div class='line' id='LC1157'>&nbsp;&nbsp;<span class="sd">/**</span></div><div class='line' id='LC1158'><span class="sd">   * Destroy the current session</span></div><div class='line' id='LC1159'><span class="sd">   */</span></div><div class='line' id='LC1160'>&nbsp;&nbsp;<span class="k">public</span> <span class="k">function</span> <span class="nf">destroySession</span><span class="p">()</span> <span class="p">{</span></div><div class='line' id='LC1161'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$this</span><span class="o">-&gt;</span><span class="na">accessToken</span> <span class="o">=</span> <span class="k">null</span><span class="p">;</span></div><div class='line' id='LC1162'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$this</span><span class="o">-&gt;</span><span class="na">signedRequest</span> <span class="o">=</span> <span class="k">null</span><span class="p">;</span></div><div class='line' id='LC1163'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$this</span><span class="o">-&gt;</span><span class="na">user</span> <span class="o">=</span> <span class="k">null</span><span class="p">;</span></div><div class='line' id='LC1164'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$this</span><span class="o">-&gt;</span><span class="na">clearAllPersistentData</span><span class="p">();</span></div><div class='line' id='LC1165'><br/></div><div class='line' id='LC1166'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="c1">// Javascript sets a cookie that will be used in getSignedRequest that we</span></div><div class='line' id='LC1167'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="c1">// need to clear if we can</span></div><div class='line' id='LC1168'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$cookie_name</span> <span class="o">=</span> <span class="nv">$this</span><span class="o">-&gt;</span><span class="na">getSignedRequestCookieName</span><span class="p">();</span></div><div class='line' id='LC1169'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">if</span> <span class="p">(</span><span class="nb">array_key_exists</span><span class="p">(</span><span class="nv">$cookie_name</span><span class="p">,</span> <span class="nv">$_COOKIE</span><span class="p">))</span> <span class="p">{</span></div><div class='line' id='LC1170'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nb">unset</span><span class="p">(</span><span class="nv">$_COOKIE</span><span class="p">[</span><span class="nv">$cookie_name</span><span class="p">]);</span></div><div class='line' id='LC1171'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">if</span> <span class="p">(</span><span class="o">!</span><span class="nx">headers_sent</span><span class="p">())</span> <span class="p">{</span></div><div class='line' id='LC1172'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="c1">// The base domain is stored in the metadata cookie if not we fallback</span></div><div class='line' id='LC1173'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="c1">// to the current hostname</span></div><div class='line' id='LC1174'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$base_domain</span> <span class="o">=</span> <span class="s1">&#39;.&#39;</span><span class="o">.</span> <span class="nv">$_SERVER</span><span class="p">[</span><span class="s1">&#39;HTTP_HOST&#39;</span><span class="p">];</span></div><div class='line' id='LC1175'><br/></div><div class='line' id='LC1176'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$metadata</span> <span class="o">=</span> <span class="nv">$this</span><span class="o">-&gt;</span><span class="na">getMetadataCookie</span><span class="p">();</span></div><div class='line' id='LC1177'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">if</span> <span class="p">(</span><span class="nb">array_key_exists</span><span class="p">(</span><span class="s1">&#39;base_domain&#39;</span><span class="p">,</span> <span class="nv">$metadata</span><span class="p">)</span> <span class="o">&amp;&amp;</span></div><div class='line' id='LC1178'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="o">!</span><span class="k">empty</span><span class="p">(</span><span class="nv">$metadata</span><span class="p">[</span><span class="s1">&#39;base_domain&#39;</span><span class="p">]))</span> <span class="p">{</span></div><div class='line' id='LC1179'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$base_domain</span> <span class="o">=</span> <span class="nv">$metadata</span><span class="p">[</span><span class="s1">&#39;base_domain&#39;</span><span class="p">];</span></div><div class='line' id='LC1180'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC1181'><br/></div><div class='line' id='LC1182'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nx">setcookie</span><span class="p">(</span><span class="nv">$cookie_name</span><span class="p">,</span> <span class="s1">&#39;&#39;</span><span class="p">,</span> <span class="mi">0</span><span class="p">,</span> <span class="s1">&#39;/&#39;</span><span class="p">,</span> <span class="nv">$base_domain</span><span class="p">);</span></div><div class='line' id='LC1183'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">}</span> <span class="k">else</span> <span class="p">{</span></div><div class='line' id='LC1184'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nx">self</span><span class="o">::</span><span class="na">errorLog</span><span class="p">(</span></div><div class='line' id='LC1185'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s1">&#39;There exists a cookie that we wanted to clear that we couldn\&#39;t &#39;</span><span class="o">.</span></div><div class='line' id='LC1186'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s1">&#39;clear because headers was already sent. Make sure to do the first &#39;</span><span class="o">.</span></div><div class='line' id='LC1187'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s1">&#39;API call before outputing anything&#39;</span></div><div class='line' id='LC1188'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">);</span></div><div class='line' id='LC1189'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC1190'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC1191'>&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC1192'><br/></div><div class='line' id='LC1193'>&nbsp;&nbsp;<span class="sd">/**</span></div><div class='line' id='LC1194'><span class="sd">   * Parses the metadata cookie that our Javascript API set</span></div><div class='line' id='LC1195'><span class="sd">   *</span></div><div class='line' id='LC1196'><span class="sd">   * @return  an array mapping key to value</span></div><div class='line' id='LC1197'><span class="sd">   */</span></div><div class='line' id='LC1198'>&nbsp;&nbsp;<span class="k">protected</span> <span class="k">function</span> <span class="nf">getMetadataCookie</span><span class="p">()</span> <span class="p">{</span></div><div class='line' id='LC1199'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$cookie_name</span> <span class="o">=</span> <span class="nv">$this</span><span class="o">-&gt;</span><span class="na">getMetadataCookieName</span><span class="p">();</span></div><div class='line' id='LC1200'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">if</span> <span class="p">(</span><span class="o">!</span><span class="nb">array_key_exists</span><span class="p">(</span><span class="nv">$cookie_name</span><span class="p">,</span> <span class="nv">$_COOKIE</span><span class="p">))</span> <span class="p">{</span></div><div class='line' id='LC1201'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">return</span> <span class="k">array</span><span class="p">();</span></div><div class='line' id='LC1202'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC1203'><br/></div><div class='line' id='LC1204'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="c1">// The cookie value can be wrapped in &quot;-characters so remove them</span></div><div class='line' id='LC1205'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$cookie_value</span> <span class="o">=</span> <span class="nx">trim</span><span class="p">(</span><span class="nv">$_COOKIE</span><span class="p">[</span><span class="nv">$cookie_name</span><span class="p">],</span> <span class="s1">&#39;&quot;&#39;</span><span class="p">);</span></div><div class='line' id='LC1206'><br/></div><div class='line' id='LC1207'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">if</span> <span class="p">(</span><span class="k">empty</span><span class="p">(</span><span class="nv">$cookie_value</span><span class="p">))</span> <span class="p">{</span></div><div class='line' id='LC1208'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">return</span> <span class="k">array</span><span class="p">();</span></div><div class='line' id='LC1209'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC1210'><br/></div><div class='line' id='LC1211'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$parts</span> <span class="o">=</span> <span class="nb">explode</span><span class="p">(</span><span class="s1">&#39;&amp;&#39;</span><span class="p">,</span> <span class="nv">$cookie_value</span><span class="p">);</span></div><div class='line' id='LC1212'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$metadata</span> <span class="o">=</span> <span class="k">array</span><span class="p">();</span></div><div class='line' id='LC1213'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">foreach</span> <span class="p">(</span><span class="nv">$parts</span> <span class="k">as</span> <span class="nv">$part</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC1214'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$pair</span> <span class="o">=</span> <span class="nb">explode</span><span class="p">(</span><span class="s1">&#39;=&#39;</span><span class="p">,</span> <span class="nv">$part</span><span class="p">,</span> <span class="mi">2</span><span class="p">);</span></div><div class='line' id='LC1215'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">if</span> <span class="p">(</span><span class="o">!</span><span class="k">empty</span><span class="p">(</span><span class="nv">$pair</span><span class="p">[</span><span class="mi">0</span><span class="p">]))</span> <span class="p">{</span></div><div class='line' id='LC1216'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nv">$metadata</span><span class="p">[</span><span class="nb">urldecode</span><span class="p">(</span><span class="nv">$pair</span><span class="p">[</span><span class="mi">0</span><span class="p">])]</span> <span class="o">=</span></div><div class='line' id='LC1217'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">(</span><span class="nb">count</span><span class="p">(</span><span class="nv">$pair</span><span class="p">)</span> <span class="o">&gt;</span> <span class="mi">1</span><span class="p">)</span> <span class="o">?</span> <span class="nb">urldecode</span><span class="p">(</span><span class="nv">$pair</span><span class="p">[</span><span class="mi">1</span><span class="p">])</span> <span class="o">:</span> <span class="s1">&#39;&#39;</span><span class="p">;</span></div><div class='line' id='LC1218'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC1219'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC1220'><br/></div><div class='line' id='LC1221'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">return</span> <span class="nv">$metadata</span><span class="p">;</span></div><div class='line' id='LC1222'>&nbsp;&nbsp;<span class="p">}</span></div><div class='line' id='LC1223'><br/></div><div class='line' id='LC1224'>&nbsp;&nbsp;<span class="sd">/**</span></div><div class='line' id='LC1225'><span class="sd">   * Each of the following four methods should be overridden in</span></div><div class='line' id='LC1226'><span class="sd">   * a concrete subclass, as they are in the provided Facebook class.</span></div><div class='line' id='LC1227'><span class="sd">   * The Facebook class uses PHP sessions to provide a primitive</span></div><div class='line' id='LC1228'><span class="sd">   * persistent store, but another subclass--one that you implement--</span></div><div class='line' id='LC1229'><span class="sd">   * might use a database, memcache, or an in-memory cache.</span></div><div class='line' id='LC1230'><span class="sd">   *</span></div><div class='line' id='LC1231'><span class="sd">   * @see Facebook</span></div><div class='line' id='LC1232'><span class="sd">   */</span></div><div class='line' id='LC1233'><br/></div><div class='line' id='LC1234'>&nbsp;&nbsp;<span class="sd">/**</span></div><div class='line' id='LC1235'><span class="sd">   * Stores the given ($key, $value) pair, so that future calls to</span></div><div class='line' id='LC1236'><span class="sd">   * getPersistentData($key) return $value. This call may be in another request.</span></div><div class='line' id='LC1237'><span class="sd">   *</span></div><div class='line' id='LC1238'><span class="sd">   * @param string $key</span></div><div class='line' id='LC1239'><span class="sd">   * @param array $value</span></div><div class='line' id='LC1240'><span class="sd">   *</span></div><div class='line' id='LC1241'><span class="sd">   * @return void</span></div><div class='line' id='LC1242'><span class="sd">   */</span></div><div class='line' id='LC1243'>&nbsp;&nbsp;<span class="k">abstract</span> <span class="k">protected</span> <span class="k">function</span> <span class="nf">setPersistentData</span><span class="p">(</span><span class="nv">$key</span><span class="p">,</span> <span class="nv">$value</span><span class="p">);</span></div><div class='line' id='LC1244'><br/></div><div class='line' id='LC1245'>&nbsp;&nbsp;<span class="sd">/**</span></div><div class='line' id='LC1246'><span class="sd">   * Get the data for $key, persisted by BaseFacebook::setPersistentData()</span></div><div class='line' id='LC1247'><span class="sd">   *</span></div><div class='line' id='LC1248'><span class="sd">   * @param string $key The key of the data to retrieve</span></div><div class='line' id='LC1249'><span class="sd">   * @param boolean $default The default value to return if $key is not found</span></div><div class='line' id='LC1250'><span class="sd">   *</span></div><div class='line' id='LC1251'><span class="sd">   * @return mixed</span></div><div class='line' id='LC1252'><span class="sd">   */</span></div><div class='line' id='LC1253'>&nbsp;&nbsp;<span class="k">abstract</span> <span class="k">protected</span> <span class="k">function</span> <span class="nf">getPersistentData</span><span class="p">(</span><span class="nv">$key</span><span class="p">,</span> <span class="nv">$default</span> <span class="o">=</span> <span class="k">false</span><span class="p">);</span></div><div class='line' id='LC1254'><br/></div><div class='line' id='LC1255'>&nbsp;&nbsp;<span class="sd">/**</span></div><div class='line' id='LC1256'><span class="sd">   * Clear the data with $key from the persistent storage</span></div><div class='line' id='LC1257'><span class="sd">   *</span></div><div class='line' id='LC1258'><span class="sd">   * @param string $key</span></div><div class='line' id='LC1259'><span class="sd">   * @return void</span></div><div class='line' id='LC1260'><span class="sd">   */</span></div><div class='line' id='LC1261'>&nbsp;&nbsp;<span class="k">abstract</span> <span class="k">protected</span> <span class="k">function</span> <span class="nf">clearPersistentData</span><span class="p">(</span><span class="nv">$key</span><span class="p">);</span></div><div class='line' id='LC1262'><br/></div><div class='line' id='LC1263'>&nbsp;&nbsp;<span class="sd">/**</span></div><div class='line' id='LC1264'><span class="sd">   * Clear all data from the persistent storage</span></div><div class='line' id='LC1265'><span class="sd">   *</span></div><div class='line' id='LC1266'><span class="sd">   * @return void</span></div><div class='line' id='LC1267'><span class="sd">   */</span></div><div class='line' id='LC1268'>&nbsp;&nbsp;<span class="k">abstract</span> <span class="k">protected</span> <span class="k">function</span> <span class="nf">clearAllPersistentData</span><span class="p">();</span></div><div class='line' id='LC1269'><span class="p">}</span></div></pre></div>
          </td>
        </tr>
      </table>
  </div>

          </div>
        </div>
      </div>
    </div>

  </div>

<div class="frame frame-loading large-loading-area" style="display:none;" data-tree-list-url="/facebook/php-sdk/tree-list/6c82b3fdfb8efd27751de028d75fd3ab1f2c1ade" data-blob-url-prefix="/facebook/php-sdk/blob/6c82b3fdfb8efd27751de028d75fd3ab1f2c1ade">
  <img src="https://a248.e.akamai.net/assets.github.com/images/spinners/octocat-spinner-64.gif?1334862346" height="64" width="64">
</div>

      </div>
      <div class="context-overlay"></div>
    </div>

      <div id="footer-push"></div><!-- hack for sticky footer -->
    </div><!-- end of wrapper - hack for sticky footer -->

      <!-- footer -->
      <div id="footer" >
        
  <div class="upper_footer">
     <div class="container clearfix">

       <!--[if IE]><h4 id="blacktocat_ie">GitHub Links</h4><![endif]-->
       <![if !IE]><h4 id="blacktocat">GitHub Links</h4><![endif]>

       <ul class="footer_nav">
         <h4>GitHub</h4>
         <li><a href="https://github.com/about">About</a></li>
         <li><a href="https://github.com/blog">Blog</a></li>
         <li><a href="https://github.com/features">Features</a></li>
         <li><a href="https://github.com/contact">Contact &amp; Support</a></li>
         <li><a href="https://github.com/training">Training</a></li>
         <li><a href="http://enterprise.github.com/">GitHub Enterprise</a></li>
         <li><a href="http://status.github.com/">Site Status</a></li>
       </ul>

       <ul class="footer_nav">
         <h4>Tools</h4>
         <li><a href="http://get.gaug.es/">Gauges: Analyze web traffic</a></li>
         <li><a href="http://speakerdeck.com">Speaker Deck: Presentations</a></li>
         <li><a href="https://gist.github.com">Gist: Code snippets</a></li>
         <li><a href="http://mac.github.com/">GitHub for Mac</a></li>
         <li><a href="http://mobile.github.com/">Issues for iPhone</a></li>
         <li><a href="http://jobs.github.com/">Job Board</a></li>
       </ul>

       <ul class="footer_nav">
         <h4>Extras</h4>
         <li><a href="http://shop.github.com/">GitHub Shop</a></li>
         <li><a href="http://octodex.github.com/">The Octodex</a></li>
       </ul>

       <ul class="footer_nav">
         <h4>Documentation</h4>
         <li><a href="http://help.github.com/">GitHub Help</a></li>
         <li><a href="http://developer.github.com/">Developer API</a></li>
         <li><a href="http://github.github.com/github-flavored-markdown/">GitHub Flavored Markdown</a></li>
         <li><a href="http://pages.github.com/">GitHub Pages</a></li>
       </ul>

     </div><!-- /.site -->
  </div><!-- /.upper_footer -->

<div class="lower_footer">
  <div class="container clearfix">
    <!--[if IE]><div id="legal_ie"><![endif]-->
    <![if !IE]><div id="legal"><![endif]>
      <ul>
          <li><a href="https://github.com/site/terms">Terms of Service</a></li>
          <li><a href="https://github.com/site/privacy">Privacy</a></li>
          <li><a href="https://github.com/security">Security</a></li>
      </ul>

      <p>&copy; 2012 <span title="0.07129s from fe13.rs.github.com">GitHub</span> Inc. All rights reserved.</p>
    </div><!-- /#legal or /#legal_ie-->

      <div class="sponsor">
        <a href="http://www.rackspace.com" class="logo">
          <img alt="Dedicated Server" height="36" src="https://a248.e.akamai.net/assets.github.com/images/modules/footer/rackspaces_logo.png?1334862346" width="38" />
        </a>
        Powered by the <a href="http://www.rackspace.com ">Dedicated
        Servers</a> and<br/> <a href="http://www.rackspacecloud.com">Cloud
        Computing</a> of Rackspace Hosting<span>&reg;</span>
      </div>
  </div><!-- /.site -->
</div><!-- /.lower_footer -->

      </div><!-- /#footer -->

    

<div id="keyboard_shortcuts_pane" class="instapaper_ignore readability-extra" style="display:none">
  <h2>Keyboard Shortcuts <small><a href="#" class="js-see-all-keyboard-shortcuts">(see all)</a></small></h2>

  <div class="columns threecols">
    <div class="column first">
      <h3>Site wide shortcuts</h3>
      <dl class="keyboard-mappings">
        <dt>s</dt>
        <dd>Focus site search</dd>
      </dl>
      <dl class="keyboard-mappings">
        <dt>?</dt>
        <dd>Bring up this help dialog</dd>
      </dl>
    </div><!-- /.column.first -->

    <div class="column middle" style='display:none'>
      <h3>Commit list</h3>
      <dl class="keyboard-mappings">
        <dt>j</dt>
        <dd>Move selection down</dd>
      </dl>
      <dl class="keyboard-mappings">
        <dt>k</dt>
        <dd>Move selection up</dd>
      </dl>
      <dl class="keyboard-mappings">
        <dt>c <em>or</em> o <em>or</em> enter</dt>
        <dd>Open commit</dd>
      </dl>
      <dl class="keyboard-mappings">
        <dt>y</dt>
        <dd>Expand URL to its canonical form</dd>
      </dl>
    </div><!-- /.column.first -->

    <div class="column last" style='display:none'>
      <h3>Pull request list</h3>
      <dl class="keyboard-mappings">
        <dt>j</dt>
        <dd>Move selection down</dd>
      </dl>
      <dl class="keyboard-mappings">
        <dt>k</dt>
        <dd>Move selection up</dd>
      </dl>
      <dl class="keyboard-mappings">
        <dt>o <em>or</em> enter</dt>
        <dd>Open issue</dd>
      </dl>
      <dl class="keyboard-mappings">
        <dt><span class="platform-mac">⌘</span><span class="platform-other">ctrl</span> <em>+</em> enter</dt>
        <dd>Submit comment</dd>
      </dl>
    </div><!-- /.columns.last -->

  </div><!-- /.columns.equacols -->

  <div style='display:none'>
    <div class="rule"></div>

    <h3>Issues</h3>

    <div class="columns threecols">
      <div class="column first">
        <dl class="keyboard-mappings">
          <dt>j</dt>
          <dd>Move selection down</dd>
        </dl>
        <dl class="keyboard-mappings">
          <dt>k</dt>
          <dd>Move selection up</dd>
        </dl>
        <dl class="keyboard-mappings">
          <dt>x</dt>
          <dd>Toggle selection</dd>
        </dl>
        <dl class="keyboard-mappings">
          <dt>o <em>or</em> enter</dt>
          <dd>Open issue</dd>
        </dl>
        <dl class="keyboard-mappings">
          <dt><span class="platform-mac">⌘</span><span class="platform-other">ctrl</span> <em>+</em> enter</dt>
          <dd>Submit comment</dd>
        </dl>
      </div><!-- /.column.first -->
      <div class="column last">
        <dl class="keyboard-mappings">
          <dt>c</dt>
          <dd>Create issue</dd>
        </dl>
        <dl class="keyboard-mappings">
          <dt>l</dt>
          <dd>Create label</dd>
        </dl>
        <dl class="keyboard-mappings">
          <dt>i</dt>
          <dd>Back to inbox</dd>
        </dl>
        <dl class="keyboard-mappings">
          <dt>u</dt>
          <dd>Back to issues</dd>
        </dl>
        <dl class="keyboard-mappings">
          <dt>/</dt>
          <dd>Focus issues search</dd>
        </dl>
      </div>
    </div>
  </div>

  <div style='display:none'>
    <div class="rule"></div>

    <h3>Issues Dashboard</h3>

    <div class="columns threecols">
      <div class="column first">
        <dl class="keyboard-mappings">
          <dt>j</dt>
          <dd>Move selection down</dd>
        </dl>
        <dl class="keyboard-mappings">
          <dt>k</dt>
          <dd>Move selection up</dd>
        </dl>
        <dl class="keyboard-mappings">
          <dt>o <em>or</em> enter</dt>
          <dd>Open issue</dd>
        </dl>
      </div><!-- /.column.first -->
    </div>
  </div>

  <div style='display:none'>
    <div class="rule"></div>

    <h3>Network Graph</h3>
    <div class="columns equacols">
      <div class="column first">
        <dl class="keyboard-mappings">
          <dt><span class="badmono">←</span> <em>or</em> h</dt>
          <dd>Scroll left</dd>
        </dl>
        <dl class="keyboard-mappings">
          <dt><span class="badmono">→</span> <em>or</em> l</dt>
          <dd>Scroll right</dd>
        </dl>
        <dl class="keyboard-mappings">
          <dt><span class="badmono">↑</span> <em>or</em> k</dt>
          <dd>Scroll up</dd>
        </dl>
        <dl class="keyboard-mappings">
          <dt><span class="badmono">↓</span> <em>or</em> j</dt>
          <dd>Scroll down</dd>
        </dl>
        <dl class="keyboard-mappings">
          <dt>t</dt>
          <dd>Toggle visibility of head labels</dd>
        </dl>
      </div><!-- /.column.first -->
      <div class="column last">
        <dl class="keyboard-mappings">
          <dt>shift <span class="badmono">←</span> <em>or</em> shift h</dt>
          <dd>Scroll all the way left</dd>
        </dl>
        <dl class="keyboard-mappings">
          <dt>shift <span class="badmono">→</span> <em>or</em> shift l</dt>
          <dd>Scroll all the way right</dd>
        </dl>
        <dl class="keyboard-mappings">
          <dt>shift <span class="badmono">↑</span> <em>or</em> shift k</dt>
          <dd>Scroll all the way up</dd>
        </dl>
        <dl class="keyboard-mappings">
          <dt>shift <span class="badmono">↓</span> <em>or</em> shift j</dt>
          <dd>Scroll all the way down</dd>
        </dl>
      </div><!-- /.column.last -->
    </div>
  </div>

  <div >
    <div class="rule"></div>
    <div class="columns threecols">
      <div class="column first" >
        <h3>Source Code Browsing</h3>
        <dl class="keyboard-mappings">
          <dt>t</dt>
          <dd>Activates the file finder</dd>
        </dl>
        <dl class="keyboard-mappings">
          <dt>l</dt>
          <dd>Jump to line</dd>
        </dl>
        <dl class="keyboard-mappings">
          <dt>w</dt>
          <dd>Switch branch/tag</dd>
        </dl>
        <dl class="keyboard-mappings">
          <dt>y</dt>
          <dd>Expand URL to its canonical form</dd>
        </dl>
      </div>
    </div>
  </div>

  <div style='display:none'>
    <div class="rule"></div>
    <div class="columns threecols">
      <div class="column first">
        <h3>Browsing Commits</h3>
        <dl class="keyboard-mappings">
          <dt><span class="platform-mac">⌘</span><span class="platform-other">ctrl</span> <em>+</em> enter</dt>
          <dd>Submit comment</dd>
        </dl>
        <dl class="keyboard-mappings">
          <dt>escape</dt>
          <dd>Close form</dd>
        </dl>
        <dl class="keyboard-mappings">
          <dt>p</dt>
          <dd>Parent commit</dd>
        </dl>
        <dl class="keyboard-mappings">
          <dt>o</dt>
          <dd>Other parent commit</dd>
        </dl>
      </div>
    </div>
  </div>
</div>

    <div id="markdown-help" class="instapaper_ignore readability-extra">
  <h2>Markdown Cheat Sheet</h2>

  <div class="cheatsheet-content">

  <div class="mod">
    <div class="col">
      <h3>Format Text</h3>
      <p>Headers</p>
      <pre>
# This is an &lt;h1&gt; tag
## This is an &lt;h2&gt; tag
###### This is an &lt;h6&gt; tag</pre>
     <p>Text styles</p>
     <pre>
*This text will be italic*
_This will also be italic_
**This text will be bold**
__This will also be bold__

*You **can** combine them*
</pre>
    </div>
    <div class="col">
      <h3>Lists</h3>
      <p>Unordered</p>
      <pre>
* Item 1
* Item 2
  * Item 2a
  * Item 2b</pre>
     <p>Ordered</p>
     <pre>
1. Item 1
2. Item 2
3. Item 3
   * Item 3a
   * Item 3b</pre>
    </div>
    <div class="col">
      <h3>Miscellaneous</h3>
      <p>Images</p>
      <pre>
![GitHub Logo](/images/logo.png)
Format: ![Alt Text](url)
</pre>
     <p>Links</p>
     <pre>
http://github.com - automatic!
[GitHub](http://github.com)</pre>
<p>Blockquotes</p>
     <pre>
As Kanye West said:

> We're living the future so
> the present is our past.
</pre>
    </div>
  </div>
  <div class="rule"></div>

  <h3>Code Examples in Markdown</h3>
  <div class="col">
      <p>Syntax highlighting with <a href="http://github.github.com/github-flavored-markdown/" title="GitHub Flavored Markdown" target="_blank">GFM</a></p>
      <pre>
```javascript
function fancyAlert(arg) {
  if(arg) {
    $.facebox({div:'#foo'})
  }
}
```</pre>
    </div>
    <div class="col">
      <p>Or, indent your code 4 spaces</p>
      <pre>
Here is a Python code example
without syntax highlighting:

    def foo:
      if not bar:
        return true</pre>
    </div>
    <div class="col">
      <p>Inline code for comments</p>
      <pre>
I think you should use an
`&lt;addr&gt;` element here instead.</pre>
    </div>
  </div>

  </div>
</div>


    <div class="ajax-error-message">
      <p><span class="icon"></span> Something went wrong with that request. Please try again. <a href="javascript:;" class="ajax-error-dismiss">Dismiss</a></p>
    </div>

    <div id="logo-popup">
      <h2>Looking for the GitHub logo?</h2>
      <ul>
        <li>
          <h4>GitHub Logo</h4>
          <a href="http://github-media-downloads.s3.amazonaws.com/GitHub_Logos.zip"><img alt="Github_logo" src="https://a248.e.akamai.net/assets.github.com/images/modules/about_page/github_logo.png?1334862345" /></a>
          <a href="http://github-media-downloads.s3.amazonaws.com/GitHub_Logos.zip" class="minibutton btn-download download"><span><span class="icon"></span>Download</span></a>
        </li>
        <li>
          <h4>The Octocat</h4>
          <a href="http://github-media-downloads.s3.amazonaws.com/Octocats.zip"><img alt="Octocat" src="https://a248.e.akamai.net/assets.github.com/images/modules/about_page/octocat.png?1334862345" /></a>
          <a href="http://github-media-downloads.s3.amazonaws.com/Octocats.zip" class="minibutton btn-download download"><span><span class="icon"></span>Download</span></a>
        </li>
      </ul>
    </div>

    
    
    
    <span id='server_response_time' data-time='0.07370' data-host='fe13'></span>
  </body>
</html>

