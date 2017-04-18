$(window).load(function(){
 var lastQuestionId =0;
 var qCounter=0;
 var bodyPart=0;
 var lastAns="yes";
 var totalYes=[]; // it have only id of question that he answer by yes

 var wizard=$("#wizardV").steps({
          headerTag: "h2",
          bodyTag: "section",
          transitionEffect: "slideLeft",
          stepsOrientation: "vertical",
        //  forceMoveForward: true,
          onStepChanged: function (event, currentIndex, newIndex){
               return true;
          }
  });
   console.log(qCounter);
  $(".gender").on("change", function(){
    alert("data changed");

  addModelStep($(this).val().toString()+".html");
  $('body').on('change', 'input[name="body_part"]:radio', function () {
    //alert("fen");
    bodyPart = $(this).val() ;
    getQ({body_part:bodyPart ,ans:"",lastquestionid:0},"get");
  });
  });
  function getCurrntIndex(){
     return parseInt(wizard.steps("getCurrentIndex"))+1;
  };
  $('#wizardV a[href="#previous"]').on('click',function(){
      wizard.steps("remove",getCurrntIndex());
if(qCounter>0)
      qCounter--;
  });

  function createStep(title,content){
    // wizard deeh hia 8lt
    wizard.steps("add", {
               title:title,
               content:content
    });
    nextStep();
  };
  //  var data={'ans':r $('input[name="ques"]').val()};
  function nextStep(){
    wizard.steps("next");
  }
  function addModelStep(fileName){
    $.get(fileName,function(res){
       createStep("test",res);
    });
  };

  function getQ(datax,method){
    $.ajax({
           url: "firstquestion.php",
           type: method,
           data:datax,
           success: function (response) {
             alert(response);
             lastQuestionId=response.wzrd_qstn_id;
             alert(lastQuestionId);
             createStep(("question "+(++qCounter).toString()),createQ(response.wzrd_qstn_txt));
             },
           error:function (ajaxcontext) {
             alert(ajaxcontext);
               alert("bazt :P");
           }
    });
  };

  $('body').on('change', 'input[name="ques"]:radio',function(){
      var val=$(this).val();
      alert("ma3ki ya  bae bodyPart "+bodyPart + "lastQuestionId "+lastQuestionId+ " ans "+ val);

//testing n3ml ajax kn2a bra function 34an m4 3arf leeh object m4 radia tit2ri

    //  getQ({body_part:bodyPart,lastquestionid:lastQuestionId,ans:val},"get");
// start toffee
alert(lastQuestionId);
      $.ajax({
             url: "firstquestion.php",
             type: "get",
             data:{body_part:bodyPart,lastquestionid:lastQuestionId,ans:val},
             success: function (response) {

               alert(lastQuestionId);
               if(val=="no")
               lastQuestionId=response.smptm_id;
               else if(val=="yes")
               lastQuestionId=response.related_smptm_id;
               createStep(("question "+(++qCounter).toString()),createQ(response.wzrd_qstn_txt));
               },
             error:function (ajaxcontext) {
                 alert("bazt :P");
             }
      });

      // ending tofee
      if(val=="yes"){
          totalYes.push(lastQuestionId);

      }else{

      }
  });
 function createQ(text){
     return '<div class="panel-body" >'+
               '<form role="form" method="post" action="">'+
               '<div class="form-group">'+
                   '<label id="txt1">'+text+'</label>'+
                   '<div class="radio">'+
                     '<input type="radio" name="ques" value="yes" class="ans-yes"> YES'+
                     '<br>'+
                     '<input type="radio" name="ques"  value="no" class="ans-no" >  NO'+
                  '</div></div>'+
               '</form>'+
             '</div>';
   };
});
