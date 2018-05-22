    $(':button').addEventListener("click", function () {
        alert(1);
    });
    $(document).ready(function(){
        alert(1);
      $(':button').click(function(){
        alert('1111');
        var content = $('#content').val();
        $.get('./createTag?content='+content, function(res){
          if (res.result === 'success') {
            setVaule(res.docId);
          } else {
            alert(res.detail);
          }
        });
      });
    });
    function setVaule(docId) {
      $.get('./getTag?docId='+docId, function (res){
        if (res.result === 'success') {
            var tags = res.data.tags;
            var language=topics=entities=relations=industries=socialtags='';
            tags.forEach(function(tag,index,array){
              switch(tag.typeGroup){
                case 'language':
                    language += ',' + tag.name;
                    break;
                case 'entities':
                    entities += '<p>'+tag.type+': '+tag.name+' '+tag.score+'%</p>';
                    break;
                case 'relations':
                    relations += '<p>'+tag.type+': '+tag.name+'</p>';
                    break;
                case 'topics':
                    topics += '<p>'+tag.name+' 'tag.score+'%</p>';
                    break;
                case 'industries':
                    industries += '<p>'+tag.name+' 'tag.score+'%</p>';
                    break;
                case 'socialtags':
                    socialtags += '<p>'+tag.name+' 'tag.score+'%</p>';
              }
            });
            $('#language').html(language);
            $('#entities').html(entities);
            $('#relations').html(relations);
            $('#topics').html(topics);
            $('#industries').html(industries);
            $('#socialtags').html(socialtags);
          } else {
            alert(res.detail);
          }
        });
    }
    function aabbc()
    {
        alert('aaaaaaaa');
    }