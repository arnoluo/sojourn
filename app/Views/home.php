<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A layout example that shows off a responsive product landing page.">
    <title>Generate Tags Demo</title>
    
    <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/pure-min.css" integrity="sha384-" crossorigin="anonymous">
    
    <!--[if lte IE 8]>
        <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/grids-responsive-old-ie-min.css">
    <![endif]-->
    <!--[if gt IE 8]><!-->
        <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/grids-responsive-min.css">
    <!--<![endif]-->
    
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    
        <!--[if lte IE 8]>
            <link rel="stylesheet" href="css/layouts/marketing-old-ie.css">
        <![endif]-->
        <!--[if gt IE 8]><!-->
            <link rel="stylesheet" href="/tag/public/css/main.css">
        <!--<![endif]-->
    <script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"> </script>
</head>
<body>

<div class="header">
    <div class="home-menu pure-menu pure-menu-horizontal pure-menu-fixed">
        <a class="pure-menu-heading" href="/tag">Generate Tags Demo</a>
        <a class="pure-menu-heading" href="/article">All Articles</a>
    </div>
</div>

<div class="splash-container">
    <div class="splash">
        <textarea id="content" class="splash-head" placeholder="text here..."></textarea>
        <p class="splash-subhead">
            输入文本，提交后向下滑动查看结果。
        </p>
        <p>
            <a type="submit" id="tagbutton" class="pure-button pure-button-primary">提交</a>
        </p>
    </div>
</div>
<div class="content-wrapper">
    <div class="content">
        <h2 class="content-head is-center mytip" id="tips"></h2>

        <div class="pure-g">
            <div class="l-box pure-u-1">
                <p id="language"></p>
            </div>
            <div class="l-box pure-u-1 pure-u-md-1-2 pure-u-lg-1-3">

                <h3 class="content-subhead">
                    <i class="fa fa-file-text-o"></i>
                    ENTITIES
                </h3>
                <div id="entities" class="write-pad"></div>
            </div>
            <div class="l-box pure-u-1 pure-u-md-1-2 pure-u-lg-1-3">
                <h3 class="content-subhead">
                    <i class="fa fa-group"></i>
                    SOCIAL TAGS
                </h3>
                <div id="socialtags" class="write-pad"></div>
            </div>
            <div class="l-box pure-u-1 pure-u-md-1-2 pure-u-lg-1-3">
                <h3 class="content-subhead">
                    <i class="fa fa-th-large"></i>
                    INDUSTRIES
                </h3>
                <div id="industries" class="write-pad"></div>
            </div>
            <div class="l-box pure-u-1 pure-u-md-1-2 pure-u-lg-1-3">
                <h3 class="content-subhead">
                    <i class="fa fa-check-square-o"></i>
                    TOPICS
                </h3>
                <div id="topics" class="write-pad"></div>
            </div>
            <div class="l-box pure-u-1 pure-u-md-1-2 pure-u-lg-1-3">
                <h3 class="content-subhead">
                    <i class="fa fa-paperclip"></i>
                    RELATIONS
                </h3>
                <div id="relations" class="write-pad"></div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
      initValue();
      $('#tagbutton').click(function(){
        initValue();
        var content = $('#content').val();
        $.get('./createTag?content='+content, function(result){
          var res = $.parseJSON(result);
          if (res.result == 'success') {
            setVaule(res.docId);
          } else {
            if(!(typeof(res.msg) == "undefined")) {
                alert(res.msg);
            } else {
                console.log(res.detail);
            }
          }
        });
      });
    });
    function setVaule(docId) {
      $.get('./getTag?docId='+docId, function (result){
        var res = $.parseJSON(result);
        if (res.result === 'success') {
            var tags = res.data.tags;
            console.log(tags);
            var language=topics=entities=relations=industries=socialtags='';
            tags.forEach(function(tag,index,array){
              switch(tag.typeGroup){
                case 'language':
                    language += ',' + tag.name;
                    break;
                case 'entities':
                    entities += '<p>'+tag.type+': '+tag.name+' <span class="score">'+tag.pivot.score+'%</span></p>';
                    break;
                case 'relations':
                    relations += '<p>'+tag.type+': </p>';
                    break;
                case 'topics':
                    topics += '<p>'+tag.name+' <span class="score">'+tag.pivot.score+'%</span></p>';
                    break;
                case 'industry':
                    industries += '<p>'+tag.name+' <span class="score">'+tag.pivot.score+'%</span></p>';
                    break;
                case 'socialTag':
                    socialtags += '<p>'+tag.name+' <span class="score">'+tag.pivot.score+'%</span></p>';
                    break;
              }
            });
            var lang = '<span class="lang">Language:</span> '+language.substring(1)
            $('#tips').html('<i class="fa fa-angle-double-down"></i>');
            $('#language').html(lang);
            $('#entities').html(entities);
            $('#relations').html(relations);
            $('#topics').html(topics);
            $('#industries').html(industries);
            $('#socialtags').html(socialtags);
          } else {
            console.log(res.detail);
          }
        });
    }
    function initValue() {
        $('#tips').html('');
        $('#language').html('');
        $('#entities').html('');
        $('#relations').html('');
        $('#topics').html('');
        $('#industries').html('');
        $('#socialtags').html('');
        $('html,body').scrollTop(0);
    }

</script>
</body>
</html>
