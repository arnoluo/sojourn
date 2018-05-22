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
    <style>
        #main-content {
            font-size: 1em;
        }
        #language, #entities, #relations, #socialtags, #industries, #topics{
            font-size: 0.83em;
        }
        #language span {
            font-size: 1em;
        }
        .pure-u-1-4 div p {
            font-size: 0.8em;
        }
        .pure-u-1-4 div p span {
            font-size: 0.8em;
        }
        .content {
            margin-top: 1em;
            border: 1px solid gray;
        }
        .footer {
            position: static;
            background: white;
            text-align: center;
            margin: 1em 0;
        }
        #tips {
            font-size: 30px;
            margin: 1em auto;
        }
        .footer div {
            margin: 0 auto;
        }
        .footer div .pure-menu-link {
            display:inline-block;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="header">
    <div class="home-menu pure-menu pure-menu-horizontal">
        <a class="pure-menu-heading" href="/tag">Generate Tags Demo</a>
        <a class="pure-menu-heading" href="/tag/article">All Articles</a>
    </div>
</div>
<div class="content-wrapper" id="main-content" style="position:static;margin-top:1em">
    <!-- <div class="content">
        <h2 class="content-head is-center mytip" id="tips"></h2>
        <div class="pure-g">
            <div class="l-box pure-u-1">
                <p id="article-content"></p>
            </div>
            <div class="l-box pure-u-1">
                <p id="language"></p>
            </div>
            <div class="l-box pure-u-1 pure-u-md-1-2 pure-u-lg-1-4">

                <h3 class="content-subhead">
                    <i class="fa fa-file-text-o"></i>
                    ENTITIES
                </h3>
                <div id="entities" class="write-pad"></div>
            </div>
            <div class="l-box pure-u-1 pure-u-md-1-2 pure-u-lg-1-4">
                <h3 class="content-subhead">
                    <i class="fa fa-group"></i>
                    SOCIAL TAGS
                </h3>
                <div id="socialtags" class="write-pad"></div>
            </div>
            <div class="l-box pure-u-1 pure-u-md-1-2 pure-u-lg-1-4">
                <h3 class="content-subhead">
                    <i class="fa fa-th-large"></i>
                    INDUSTRIES
                </h3>
                <div id="industries" class="write-pad"></div>
            </div>
            <div class="l-box pure-u-1 pure-u-md-1-2 pure-u-lg-1-4">
                <h3 class="content-subhead">
                    <i class="fa fa-check-square-o"></i>
                    TOPICS
                </h3>
                <div id="topics" class="write-pad"></div>
            </div>
            <div class="l-box pure-u-1 pure-u-md-1-2 pure-u-lg-1-4" style="display:none;">
                <h3 class="content-subhead">
                    <i class="fa fa-paperclip"></i>
                    RELATIONS
                </h3>
                <div id="relations" class="write-pad"></div>
            </div>
        </div>
    </div> -->

</div>

<script type="text/javascript">
    var offset = 0;
    var size = 10;
    $(document).ready(function(){
      //getAllArticles(offset,size);
    });

    function prev() {
        offset--;
        if (offset < 0) {
            alert('已是首页!');
            offset = 0;
        }
        getAllArticles(offset,size);
    }
    function next() {
        offset++;
        getAllArticles(offset,size);
    }

    function getAllArticles(offset = 0, size = 10) {
        $.get('./all?offset='+offset+'&size='+size, function(result){
          var res = $.parseJSON(result);
          if (res.result == 'success') {
            if (res.data) {
                initValue();
                setValue(res.data);
            } else {
                alert('已是最后一页！');
            }
          } else {
            if(!(typeof(res.msg) == "undefined")) {
                alert(res.msg);
            } else {
                console.log(res.detail);
            }
          }
        });
    }

    function setValue(articles) {
        var html = '';
        articles.forEach(function(article,index,array){
          var data = tagData(article.tags);
          data[0] = article.content;
          data[7] = 'EntityId: '+article.entity_id;
          html+=articleTpl(data);
        });
        html+='<div class="footer pure-g"><div class="pure-u-1-2"><a class="pure-u-1-2 pure-menu-link" id="prev" onclick="prev();" type="submit">上一页</a><a class="pure-u-1-2 pure-menu-link" id="next" onclick="next();" type="submit">下一页</a></div></div>';
        $('#main-content').html(html);
    };

    function articleTpl(data) {
        var tpl = '<div class="content"><h2 class="content-head is-center mytip" id="tips">'+data[7]+'</h2><div class="pure-g"><div class="l-box pure-u-1"><p id="article-content">'+data[0]
            +'</p></div><div class="l-box pure-u-1" style="display:none;"><p id="language">'+data[1]
            +'</p></div><div class="pure-u-1-4"><h5 class="content-subhead"><i class="fa fa-file-text-o"></i>ENTITIES</h3><div id="entities" class="write-pad">'+data[2]
            +'</div></div><div class="pure-u-1-4"><h5 class="content-subhead"><i class="fa fa-group"></i>SOCIAL TAGS</h3><div id="socialtags" class="write-pad">'+data[3]
            +'</div></div><div class="pure-u-1-4"><h5 class="content-subhead"><i class="fa fa-th-large"></i>INDUSTRIES</h3><div id="industries" class="write-pad">'+data[4]
            +'</div></div><div class="pure-u-1-4"><h5 class="content-subhead"><i class="fa fa-check-square-o"></i>TOPICS</h3><div id="topics" class="write-pad">'+data[5]
            +'</div></div><div class="pure-u-1-4" style="display:none;"><h5 class="content-subhead"><i class="fa fa-paperclip"></i>RELATIONS</h3><div id="relations" class="write-pad">'+data[6]
            +'</div></div></div></div>';
        return tpl;
    }

    function tagData(tags) {
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
        var lang = '<span class="lang">Language:</span> '+language.substring(1);
        return Array('', lang, entities, socialtags, industries, topics, relations);
    }

    function initValue() {
        $('#main-content').html('');
        $('html,body').scrollTop(0);
    }

</script>
</body>
</html>
