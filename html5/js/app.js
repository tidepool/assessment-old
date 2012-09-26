/*=====================
 || Global
 =====================*/

// TODO

// Balloon strings slightly off in Firefox
// Bug in Safari with balloons if images aren't loaded. Recreate and test

// Change cloud to mousedown instead of click?
// Test Sec2+3 on iPad
// Add sun to Clouds
// Need to move the balloon top image into it's own containing div

// Amazon all images

/* Secondary */
// Continuous IE testing
// Clean up section 2 click code (Make it DRY)
// Suggest that they might want to track when people try closing the app before finishing

var copy = {
    section11Instructions: "Pick your favorite pictures and order them in rank by dragging them into the corresponding frame",
    section11EndingMessage: "<strong>To continue, drag the last picture to the trash can</strong>",
    section12Instructions: "Next, select the picture you like more.<br/>Be aware that you only have a limited time<div class='sub-final'>(Click anywhere to continue when you are ready)</div>",
    section12ActiveInstructions: "Pick your favorite picture",
    section21Instructions: "In the following screen, click each cloud that interests you.<br/>You may change the speed of the clouds<br/> using the controls at the bottom.<div class='sub-final'>(Click anywhere to continue when you are ready)</div>",
    section21ActiveInstructions: "Select each cloud that interests you",
    section21ActiveInstructions2: "Change Cloud Speed",
    section22ActiveInstructions: "Raise or lower the balloons according to your interests"
};

/*==========================================
 ============================================
 || Section 1.1 GLOBALS
 ============================================
 ==========================================*/

var assetData = {
    "sections":[{ // Section 1.1
        "sectionData": [
            {"imageURL": "http://s3.amazonaws.com/tidepool_flash/frames/assets/F1a.jpg", "photoID": "a"},
            {"imageURL": "http://s3.amazonaws.com/tidepool_flash/frames/assets/F1b.jpg", "photoID": "b"},
            {"imageURL": "http://s3.amazonaws.com/tidepool_flash/frames/assets/F1c.jpg", "photoID": "c"},
            {"imageURL": "http://s3.amazonaws.com/tidepool_flash/frames/assets/F1d.jpg", "photoID": "d"},
            {"imageURL": "http://s3.amazonaws.com/tidepool_flash/frames/assets/F1e.jpg", "photoID": "e"}
        ]
    },{
        "sectionData": [
            {"imageURL": "http://s3.amazonaws.com/tidepool_flash/frames/assets/F2a.jpg", "photoID": "a"},
            {"imageURL": "http://s3.amazonaws.com/tidepool_flash/frames/assets/F2b.jpg", "photoID": "b"},
            {"imageURL": "http://s3.amazonaws.com/tidepool_flash/frames/assets/F2c.jpg", "photoID": "c"},
            {"imageURL": "http://s3.amazonaws.com/tidepool_flash/frames/assets/F2d.jpg", "photoID": "d"},
            {"imageURL": "http://s3.amazonaws.com/tidepool_flash/frames/assets/F2e.jpg", "photoID": "e"}
        ]
    },{
        "sectionData": [
            {"imageURL": "http://s3.amazonaws.com/tidepool_flash/frames/assets/F3a.jpg", "photoID": "a"},
            {"imageURL": "http://s3.amazonaws.com/tidepool_flash/frames/assets/F3b.jpg", "photoID": "b"},
            {"imageURL": "http://s3.amazonaws.com/tidepool_flash/frames/assets/F3c.jpg", "photoID": "c"},
            {"imageURL": "http://s3.amazonaws.com/tidepool_flash/frames/assets/F3d.jpg", "photoID": "d"},
            {"imageURL": "http://s3.amazonaws.com/tidepool_flash/frames/assets/F3e.jpg", "photoID": "e"}
        ]
    },{
        "sectionData": [
            {"imageURL": "http://s3.amazonaws.com/tidepool_flash/frames/assets/F4a.jpg", "photoID": "a"},
            {"imageURL": "http://s3.amazonaws.com/tidepool_flash/frames/assets/F4b.jpg", "photoID": "b"},
            {"imageURL": "http://s3.amazonaws.com/tidepool_flash/frames/assets/F4c.jpg", "photoID": "c"},
            {"imageURL": "http://s3.amazonaws.com/tidepool_flash/frames/assets/F4d.jpg", "photoID": "d"},
            {"imageURL": "http://s3.amazonaws.com/tidepool_flash/frames/assets/F4e.jpg", "photoID": "e"}
        ]
    },{
        "sectionData": [
            {"imageURL": "http://s3.amazonaws.com/tidepool_flash/frames/assets/F5a.jpg", "photoID": "a"},
            {"imageURL": "http://s3.amazonaws.com/tidepool_flash/frames/assets/F5b.jpg", "photoID": "b"},
            {"imageURL": "http://s3.amazonaws.com/tidepool_flash/frames/assets/F5c.jpg", "photoID": "c"},
            {"imageURL": "http://s3.amazonaws.com/tidepool_flash/frames/assets/F5d.jpg", "photoID": "d"},
            {"imageURL": "http://s3.amazonaws.com/tidepool_flash/frames/assets/F5e.jpg", "photoID": "e"}
        ]
    },{
        "sectionData": [
            {"imageURL": "http://s3.amazonaws.com/tidepool_flash/frames/assets/F6a.jpg", "photoID": "a"},
            {"imageURL": "http://s3.amazonaws.com/tidepool_flash/frames/assets/F6b.jpg", "photoID": "b"},
            {"imageURL": "http://s3.amazonaws.com/tidepool_flash/frames/assets/F6c.jpg", "photoID": "c"},
            {"imageURL": "http://s3.amazonaws.com/tidepool_flash/frames/assets/F6d.jpg", "photoID": "d"},
            {"imageURL": "http://s3.amazonaws.com/tidepool_flash/frames/assets/F6e.jpg", "photoID": "e"}
        ]
    },{
        "sectionData": [
            {"imageURL": "http://s3.amazonaws.com/tidepool_flash/frames/assets/F7a.jpg", "photoID": "a"},
            {"imageURL": "http://s3.amazonaws.com/tidepool_flash/frames/assets/F7b.jpg", "photoID": "b"},
            {"imageURL": "http://s3.amazonaws.com/tidepool_flash/frames/assets/F7c.jpg", "photoID": "c"},
            {"imageURL": "http://s3.amazonaws.com/tidepool_flash/frames/assets/F7d.jpg", "photoID": "d"},
            {"imageURL": "http://s3.amazonaws.com/tidepool_flash/frames/assets/F7e.jpg", "photoID": "e"}
        ]
    }, { // Section 1.2 (Frames 2)
        "sectionData": [
            {"imageURL": "http://s3.amazonaws.com/tidepool_flash/frames/assets/F1a.jpg", "photoID": "a"},
            {"imageURL": "http://s3.amazonaws.com/tidepool_flash/frames/assets/F1b.jpg", "photoID": "b"}
        ]
    }]
};


var assetDir = "http://s3.amazonaws.com/tidepool_flash/frames/assets/";

var framesDir = "http://s3.amazonaws.com/tidepool_flash/frames/assets/";
var cloudsDir = "http://s3.amazonaws.com/tidepool_flash/clouds/assets/";

/*==========================================
 ============================================
 || SECTION OBJECTS
 ============================================
 ==========================================*/

var tracker = new Tracker();
var cloudTracker;

var preloader = {};

var fr1AssetPaths = [];
var fr2AssetPaths = [];
var c1AssetPaths = [];
var c2AssetPaths = [];

var userID;

var AssetLoader = {
    "preloadAssets": function(){

    }
};

// On DOM ready
$(function(){

     $.ajax({
     type: 'POST',
     url: '../Posts/GetID.php',
     data: {},
     success: function(data){ console.log(data); userID = data['value'];},
     error: function(XMLHttpRequest, textStatus, errorThrown){
         alert("there was an error1 "+XMLHttpRequest.responseText);
         alert("there was an error2 "+textStatus);
         alert("there was an error3 "+errorThrown);},
     dataType: 'json'
     });

    // Show loading graphics
    var loadingDiv = '<div id="loading"></div>';
    $('.section').append(loadingDiv);

    var target = document.getElementById("loading");
    var spinner = new Spinner({width: 4}).spin(target);

    Helper.buildAssetArrays();

    // Preload section images
    $.imgpreload(fr1AssetPaths, function(){
        // Finished loading section 1 assets
        $('#loading').remove();
        Frames1.initSection();
        //Clouds.initSection();

        // Begin loading section 2 assets
        $.imgpreload(fr2AssetPaths, function(){
            // Finished loading section 2 assets
            // Begin loading section 3 assets
            $.imgpreload(c1AssetPaths, function(){
                //console.log(this);
                $.imgpreload(c2AssetPaths, function(){

                });
            });
        });
    });

    //Frames2.initSection();
    //Clouds.initSection();
});

// Due to added complexity, Section 1 (Frames1) relies on Backbone objects.
// Currently it is the only section that makes use of backbone-objects.js

/*



 ----------------------------- FRAMES 1






 */

var Frames1 = {
    "initSection": function(){
        this.initializeCopy();
        this.initializeAssets();
        this.renderSection();
        this.initializeJQueryTouch();
    },
    "initializeJQueryTouch": function(){

        $(".photoRow").addTouch();
    },
    "initializeCopy": function(){
        // Populate copy
        // Intro
        $('.sectionCopy').append('<div class="sectionCopyIntro">'+copy.section11Instructions+'</div>');

        $('.sectionCopy').append('<div class="sectionCopyEnd">'+copy.section11EndingMessage+'</div>');
        // Ending message
    },
    "initializeAssets": function(){
        this.photoList = new PhotoList();
        this.photoRowView = new PhotoRowView({collection: this.photoList});

        // One single PhotoFrame (model)
        this.pf = new PhotoFrameModel();

        this.tcv = new TrashCanView({model: this.pf});

        var pframeView1 = new PhotoFrameView({id: 'frame1', model: this.pf});
        $('.section').append(pframeView1.el);

        var pframeView2 = new PhotoFrameView({id: 'frame2', model: this.pf});
        $('.section').append(pframeView2.el);

        var pframeView3 = new PhotoFrameView({id: 'frame3', model: this.pf});
        $('.section').append(pframeView3.el);

        var pframeView4 = new PhotoFrameView({id: 'frame4', model: this.pf});
        $('.section').append(pframeView4.el);

        // Extended drop areas (not actually frames)
        var pframeView5 = new PhotoFrameView({id: 'frameExtended', model: this.pf});
        $('.section').append(pframeView5.el);

        var pframeView6 = new PhotoFrameView({id: 'frameExtended_2', model: this.pf});
        $('.section').append(pframeView6.el);

        var pframeView7 = new PhotoFrameView({id: 'frameExtended_3', model: this.pf});
        $('.section').append(pframeView7.el);

        var pframeView8 = new PhotoFrameView({id: 'frameExtended_4', model: this.pf});
        $('.section').append(pframeView8.el);

        var pframeView9 = new PhotoFrameView({id: 'frameExtended_5', model: this.pf});
        $('.section').append(pframeView9.el);

        var photoRowDiv = '<div class="photoRow"></div>';
        $('.section').append(photoRowDiv);

        // Populate photoRowDiv with the photoRowView
        $('.photoRow').html(this.photoRowView.el);

        $('.section').append('<div id="trashCan"></div>');
        $('#trashCan').html(this.tcv.el);

    },
    "renderSection": function(){
        // Send in photo URLs (based on current section)

        if(Frames1.currentSection > 0) this.photoRowView.clearView();

        this.photoList.reset(assetData.sections[Frames1.currentSection].sectionData);
        this.photoRowView.render();

    },
    "newSection": function(){
        // Reset and go to next section
        if(Frames1.currentSection >= Frames1.totalSections-1){
            tracker.set('changeString', tracker.get('changeString') + "*total@" + (new Date().getTime() - tracker.get("taskTime")) + '</set' + (Frames1.currentSection+1) + '></frames1><frames2>');
            Frames1.nextInterface();
        }
        else {
            tracker.set('changeString', tracker.get('changeString') + "*total@" + (new Date().getTime() - tracker.get("taskTime")) + '</set' + (Frames1.currentSection+1) + '><set' + (Frames1.currentSection+2) + '>');
            tracker.set("taskTime", new Date().getTime());
        }

        Frames1.photoConID = 0;
        Frames1.currentSection++;
        this.pf.set('occupied', ['0','0','0','0']);

        this.renderSection();
        // Store data in global object

    },
    "sizePhotoInFrame": function(item, photoID){
        if(photoID === 'frame1') {
            // Top frame, large position
            $(item).css('position', 'absolute');
            $(item).css('width', 314);
            $(item).css('height', 213);
            $(item).css('top', -497);
            $(item).css('left', 280);
        }
        else { // Smaller frames
            $(item).css('position', 'absolute');
            $(item).css('width', 171);
            $(item).css('height', 147);
            $(item).css('left', 94);
            $(item).css('top', -222);
        }

        if(photoID === 'frame3'){
            $(item).css('width', 171);
            $(item).css('left', 360);
        }

        if(photoID === 'frame4'){
            $(item).css('width', 171);
            $(item).css('left', 613);
        }

        // Vertical centering
        // Get child image's height (Note: after the above sizing adjustments have been made)

        var child = $(item).children();
        var childHeight = child.height();

        var frameHeight = parseInt($(item).css('height').split('px')[0]);
        var adjust = Math.abs((childHeight / 2) - (frameHeight / 2));

        $(item).css('margin-top', adjust);
    },
    "arraysEqual": function(a, b){
        return !(a<b || b<a);
    },
    "nextInterface": function(){
        // 1. Clean up section's elements
        // TODO
        $('.section').html("");

        // 2. Initialize next section
        Frames2.initSection();
    },
    "preMouseUpData": null, // Stores the frame data before the mouse up. On mouseup, compare
    "currentSection": 0,
    "totalSections": 7, // 7
    "photoPositions": [-10, 175, 352, 525, 695],
    "photoConID": 0, // // Incremented with each photo created. Needs to be reset for a new row
    "selectedFrameHeight": 0,
    "trashIsShowing": false // Trash can is showing. Hide it if number of empty frames is greater than 0
};

/*



 ----------------------------- FRAMES 2






 */

var Frames2 = {
    "initSection": function(){

        // 1. Show message
        this.initCopy();

        // 2. Load interface elements
        this.initInterface();

        // 3. Listen for click
        this.listenForClick();
    },
    "initCopy": function(){

        // Intro
        $('.sectionCopyEnd').html('');
        $('.sectionCopyIntro').html(copy.section12Instructions);
        $('.sectionCopyIntro').css('background', 'url("img/promptBox.png") no-repeat center top');
        $('.sectionCopyIntro').css('font-size', '1.4em');
        $('.sectionCopyIntro').css('text-align', 'center');
        $('.sectionCopyIntro').css('height', '200px');
        $('.sectionCopyIntro').css('padding-top', '17px');
        $('.sectionCopyContainer').css('padding-left', '0');
        $('.sectionCopy').css('width', '999px');
        $('.sectionCopy').css('margin-top', '200px');
    },
    "initInterface": function(){
        $('.container').css("background-image", "none");
        // Should probably create a div to hold the frames?
        var newFramesHTML = "<div class='frames2Con'><div class='fSelect1'>&nbsp;</div><div class='fSelect2'>&nbsp;</div></div>";
        $('.section').html(newFramesHTML);

        // Load first set of photos
        this.loadPhotoSet();
    },
    "listenForClick": function(){
        var that = this;
        $('.clickToContinue').show();
        $('.clickToContinue').bind("click touch", function(){
            //console.log("INIT FUNC 1");
            $('.clickToContinue').hide();
            that.initFunctionality();
            $('.clickToContinue').unbind("click touch");

        });
    },
    "initFunctionality": function(){
        tracker.set('taskTime', new Date().getTime());
        // Hide/show interface elements
        $('.sectionCopyIntro').html(copy.section12ActiveInstructions);
        $('.sectionCopy').css('margin-top', '0');
        $('.sectionCopyIntro').css('background', '');
        $('.frames2Con').css('display', 'block');
        this.initTimer();
        this.resetTimer();
    },
    "initTimer": function(){
        var timerHTML = '<div class="slideTimer"><div class="sliver"></div><div class="timerBar"></div></div>';
        $('.section').append(timerHTML);
    },
    "resetTimer": function(){
        if(this.currentIntervalID){
            window.clearInterval(this.currentIntervalID);
        }
        var that = this;

        $('.timerBar').css("width", "681px");
        tracker.set('changeTime', tracker.get('elapsed'));

        this.currentIntervalID = window.setInterval(function(){
            var sectionElapsed = tracker.get("elapsed") - tracker.get("changeTime");
            if(sectionElapsed >= 5000){

                tracker.set('changeString', tracker.get('changeString') + "<set" + that.currentSet +">1*@" + (new Date().getTime() - tracker.get('taskTime')) + "</set" + that.currentSet + ">");

                tracker.addPair({currPair: that.currentSet, selectedPair: "0"});
                that.selections.push("0");
                that.currentSet++;
                ProgressBar.addProgress(Math.floor(50 / that.totalPairs));

                if(that.currentSet === (that.totalPairs+1)){
                    that.nextInterface();
                }else {
                    tracker.set('taskTime', new Date().getTime());
                    that.loadPhotoSet();
                    that.resetTimer();

                }

            }
            var progressBarWidth = 681 - ((sectionElapsed / 5000) * 681);
            $('.timerBar').css('width', progressBarWidth);
        }, 10);

    },
    "loadPhotoSet": function(){
        var that = this;

        $('.fSelect1').unbind('click');
        $('.fSelect2').unbind('click');

        $('.fSelect1').html("");
        $('.fSelect2').html("");

        var img = new Image();

        $(img).load(function(){

            $('.fSelect1').html(this);
            $(this).addClass('photoA');

            Helper.adjustHeight(this);

            $('.fSelect1').click(function(){
                tracker.set('changeString', tracker.get('changeString') + "<set" + that.currentSet +">0*@" + (new Date().getTime() - tracker.get('taskTime')) + "</set" + that.currentSet + ">");
                tracker.addPair({currPair: that.currentSet, selectedPair: "a"});
                that.selections.push("a");
                that.currentSet++;

                ProgressBar.addProgress(Math.floor(50 / that.totalPairs));

                if(that.currentSet === (that.totalPairs+1)){
                    that.nextInterface();
                }else {
                    tracker.set('taskTime', new Date().getTime());
                    that.loadPhotoSet();
                    that.resetTimer();
                }
            });
        }).attr('src', assetDir + 'P'+ this.currentSet +'a.jpg');

        var img2 = new Image();

        $(img2).load(function(){

            $('.fSelect2').html(this);
            $(this).addClass('photoB');

            Helper.adjustHeight(this);

            $('.fSelect2').click(function(){
                tracker.set('changeString', tracker.get('changeString') + "<set" + that.currentSet +">0*@" + (new Date().getTime() - tracker.get('taskTime')) + "</set" + that.currentSet + ">");
                tracker.addPair({currPair: that.currentSet, selectedPair: "b"});
                that.selections.push("b");
                that.currentSet++;

                ProgressBar.addProgress(Math.floor(50 / that.totalPairs));

                if(that.currentSet === (that.totalPairs+1)){
                    that.nextInterface();
                }else {
                    tracker.set('taskTime', new Date().getTime());
                    that.loadPhotoSet();
                    that.resetTimer();
                }
            });
        }).attr('src', assetDir + 'P'+ this.currentSet +'b.jpg');
    },
    "nextInterface": function(){
        // Kill timer

        ProgressBar.setProgress(-100);

        tracker.set('changeString', tracker.get('changeString')+ '</frames2></changes>');

        DataPipeline.sendFrameData(userID);

        if(this.currentIntervalID){
            window.clearInterval(this.currentIntervalID);
        }

        $('.section').html("");
        // Initialize next section
        Clouds.initSection();

    },
    "selections": [],
    "currentSet": 1,
    "currentIntervalID": null,
    "totalPairs": 14, // 14
    "pairsPreloaded": 0,
    "imagesInSetPreloaded": 0 // Once set to 2, load the next set
};

/*



 ----------------------------- CLOUDS






 */

var Clouds = {
    "initSection": function(){

        // 1. Show intro message
        this.initCopy();

        // 2. Load interface elements
        this.initInterface();

        // 3. Listen for click
        window.setTimeout(this.listenForClick, 500);

    },
    "initCopy": function(){
        // section21Instructions
        $('.sectionCopyIntro').html(copy.section21Instructions);
        $('.sectionCopyIntro').css('background', 'url("img/promptBox.png") no-repeat center top');
        $('.sectionCopyIntro').css('font-size', '1.2em');
        $('.sectionCopyIntro').css('text-align', 'center');
        $('.sectionCopyIntro').css('height', '200px');
        $('.sectionCopyIntro').css('padding-top', '10px');
        $('body').css('background', 'url("img/cloud-background.jpg") repeat-x');

        //$('.sectionCopy').css('width', '999px');
        $('.sectionCopy').css('margin-top', '200px');
    },
    "listenForClick": function(){
        $('.clickToContinue').show();

        $('.clickToContinue').bind("click touch", function(){
            $('.clickToContinue').hide();
            Clouds.initFunctionality();
            $('.clickToContinue').unbind("click touch");

        });
    },
    "initFunctionality": function(){

        $('body').css("overflow", "hidden");

        $('.sectionCopyIntro').html(copy.section21ActiveInstructions);
        $('.sectionCopy').css('margin-top', '0');
        $('.sectionCopyIntro').css('background', '');

        $('.speedCon').show();

        cloudTracker = new CloudTracker();

        this.runClouds(this.currentSpeed);

    },
    "runClouds": function(speed){
        var that = this;

        $('.cloudContainer').show();
        //window.setInterval(function(){
        // Check cloud positions
        //console.log($('.cloudCon').css('left'));
        //}, 1000);

        if(this.currentIntervalID){
            window.clearInterval(this.currentIntervalID);
        }

        // New interval
        this.currentIntervalID = window.setInterval(function(){
            that.getCloudPositionAsPercentage();
            that.cloudDuration -= that.animationSpeed;
        }, that.animationSpeed);

        $('.cloudContainer').animate({left: '1400'}, {duration:that.cloudDuration, easing:'linear', complete:that.finishedAnimating});

        // Cloud movement, pixels per second (original flash version)
        // 102 - Slower
        // 204 - Faster
    },
    "changeAnimationSpeed": function() {

        var that = this;

        console.log("CHANGE SPEED");
        //console.log( $('.cloudContainer').css('-webkit-transform') );
        //console.log( $('.cloudContainer').css('-webkit-transform') );

        //console.log(Helper.matrixToArray($('.cloudContainer').css('-webkit-transform'))[4]);


        this.bankedMovement += parseInt(this.lastTransformValue, 10);

        console.log(this.lastTransformValue);

        console.log( ' Banked movement: ' + this.bankedMovement);


        if(this.currentIntervalID){
            window.clearInterval(this.currentIntervalID);
        }

        // New interval
        this.currentIntervalID = window.setInterval(function(){
            that.getCloudPositionAsPercentage();
            that.cloudDuration -= that.animationSpeed;
        }, that.animationSpeed);
    },
    "finishedAnimating": function(){
        console.log('finished animating');

        Clouds.nextInterface();
    },
    "initInterface": function(){
        // Create clouds
        this.createClouds();
        this.createSpeedButton();
    },
    "createClouds": function(){
        var numClouds = this.picStrings.length;
        var cloudContainer = '<div class="cloudContainer"></div>';
        var cloudX = 0;
        var cloudY = 0;

        $('body').append(cloudContainer);

        for (var i = 0; i < numClouds; i++) {
            if(cloudY === 0) cloudY = 250;
            else cloudY = 0;

            //var cloudID = Helper.randomNum(0, (this.picStrings.length -1));
            var cloudID = this.orderNumbers[i]-1;
            console.log("cloud id "+cloudID);
            var cloudData = this.picStrings[cloudID];
            console.log("trying to split"+cloudData);
            var cloudDescripText = cloudData.split('_')[0];
            console.log("split"+cloudData);
            var cloudSplitID = cloudData.split('_')[1];

            //this.picStrings.splice(cloudID, 1);

            var divString = '<div class="cloudCon id' + cloudSplitID +'" style="position:absolute; top:' +cloudY+ 'px; left:'+cloudX+'px;"><div class="cloudDescription">'+cloudDescripText+'</div><div class="cloudImage"><img src="' + cloudsDir + 'Numbers/' + cloudSplitID + '.jpg" /></div><div class="cloud"></div></div>';

            cloudX += 200;
            $('.cloudContainer').append(divString);
        }

        /* Cloud functionality */
        $('.cloudCon').hover(function(){
                var kids = $(this).children();
                var img = $(kids[1]).children();
                $(kids[0]).css('color', 'blue');
                $(img).css('border', '2px solid blue');

            },
            function(){
                var kids = $(this).children();
                var img = $(kids[1]).children();
                $(kids[0]).css('color', '#000');
                $(img).css('border', '2px solid #000');

            });

        $('.cloudCon').bind('click touchstart', function(){
            var cloudID = $(this).attr('class').split('id')[1];
            cloudTracker.trackCloudClick(cloudID);
            $(this).remove();
        });
    },
    "createSpeedButton": function(){
        var speedDiv = '<div class="speedCon"><div class="speedText"> ' + copy.section21ActiveInstructions2 +' </div><div class="speedButton">Faster</div></div>';
        $('.section').append(speedDiv);
        var that = this;
        $('.speedButton').click(function(){
            console.log("speed changed");
            if(that.currentSpeed === 33){
                // Make faster
                cloudTracker.trackSpeedChange("4");
                $('.speedButton').html("Slower");
                that.currentSpeed = 17;
                $('.cloudContainer').stop();
                that.animationSpeed = 50;
                that.changeAnimationSpeed();
                $('.cloudContainer').animate({left: '1400'}, {duration:that.cloudDuration / 2, easing:'linear', complete:that.finishedAnimating});
                // that.runClouds(17);
            }else {
                // Make slower
                cloudTracker.trackSpeedChange("2");
                $('.speedButton').html("Faster");
                $('.cloudContainer').stop();
                that.animationSpeed = 100;
                that.changeAnimationSpeed();
                $('.cloudContainer').animate({left: '1400'}, {duration:that.cloudDuration, easing:'linear', complete:that.finishedAnimating});
                that.currentSpeed = 33;
                // that.runClouds(33);
            }
        });
    },
    "getCloudPositionAsPercentage":function(){

        //console.log('Banked movement: '+Clouds.bankedMovement);
        //console.log(Helper.matrixToArray($('.cloudContainer').css('-webkit-transform'))[4]);
        //console.log(Helper.matrixToArray($('.cloudContainer').css('-moz-transform'))[4]);
        if(Helper.matrixToArray($('.cloudContainer').css('-webkit-transform'))[4] === undefined){
            this.lastTransformValue = Helper.matrixToArray($('.cloudContainer').css('-moz-transform'))[4];
        }
        else {
            this.lastTransformValue = Helper.matrixToArray($('.cloudContainer').css('-webkit-transform'))[4];
        }


        //console.log(Helper.matrixToArray($('.cloudContainer').css('-webkit-transform'))[4] + Clouds.bankedMovement);
        //console.log('lastTransformValue:: '+ this.lastTransformValue);

        // console.log('total:::::: '+parseInt(parseInt(this.lastTransformValue, 10) + parseInt(Clouds.bankedMovement, 10), 10));
        var total = parseInt(this.lastTransformValue, 10) + parseInt(Clouds.bankedMovement, 10);
        //console.log('total::::' + total);

        var percentage = Math.floor((((total) * 100 ) / 14698 ));
        // console.log('percentage::::');
        // console.log(percentage);

        /*
         pixelDim = pixelDim + 13400;
         // Height: 600 - 200 = 400 * 100 = 40,000 / 400 = 100
         // Height: 300 - 200 = 100 * 100 = 10,000/ 400 = 25

         var percentage = Math.floor((((pixelDim - 0) * 100) / 13400));
         console.log(percentage);*/

        if(percentage > 1){
            var newCalc = Math.floor(percentage / 2);
            ProgressBar.setProgress(-100 + newCalc);
        }

        //return percentValue;
    },
    "nextInterface": function(){
        ProgressBar.setProgress(-50);
        // Clean up and init next section
        if(this.currentIntervalID){
            window.clearInterval(this.currentIntervalID);
        }
        $('.cloudContainer').remove();
        $('.speedCon').remove();

        Balloons.initSection();
    },
    "picStrings": [
        "Arrange or compose music of any kind_1"
        ,"Create portraits or photographs_2"
        ,"Design fashion, furniture, interiors, or posters_3"
        ,"Perform for Others_4"
        ,"Play in a band, group, or orchestra_5"
        ,"Practice a musical Instrument_6"
        ,"Read artistic, literary, or musical articles_7"
        ,"Sketch, draw, or paint_8"
        ,"Take an Art course_9"
        ,"Work with a gifted artist, writer, or sculptor_10"
        ,"Write novels or plays_11"
        ,"Add, subtract, multiply, and divide numbers in business or bookkeeping_12"
        ,"Check paperwork or products for errors or flaws_13"
        ,"Fill out income tax forms_14"
        ,"Keep detailed records of expenses_15"
        ,"Operate office machines_16"
        ,"Set up a record-keeping system_17"
        ,"Take a Commercial Math Course_18"
        ,"Take an Accounting Course_19"
        ,"Take an inventory of supplies_20"
        ,"Update records or files_21"
        ,"Work in an office_22"
        ,"Act as an organizational or business consultant_23"
        ,"Attend sales conferences_24"
        ,"Lead a group in accomplishing some goal_25"
        ,"Learn strategies for business success_26"
        ,"Meet important executives and leaders_27"
        ,"Operate my own service or business_28"
        ,"Participate in a political campaign_29"
        ,"Read business magazines or articles_30"
        ,"Serve as an officer of any group_31"
        ,"Supervise the work of others_32"
        ,"Take a short course on administration or leadership_33"
        ,"Apply mathematics to practical problems_34"
        ,"Read scientific books or magazines_35"
        ,"Study a scientific theory_36"
        ,"Study scholarly or technical problems_37"
        ,"Take a Biology Course_38"
        ,"Take a Chemistry Course_39"
        ,"Take a Mathematics course_40"
        ,"Take a Physics course_41"
        ,"Work in a research office or laboratory_42"
        ,"Work on a scientific project_43"
        ,"Work with chemicals_44"
        ,"Build things with wood_45"
        ,"Fix electrical things_46"
        ,"Fix mechanical things_47"
        ,"Operate motorized machines or equipment_48"
        ,"Repair cars_49"
        ,"Take a Mechanical Drawing course_50"
        ,"Take a Technology Education (e.g. Industrial Arts, Shop) course_51"
        ,"Take a Woodworking Course_52"
        ,"Take an Auto Mechanics course_53"
        ,"Work outdoors_54"
        ,"Work with an outstanding mechanic or technician_55"
        ,"Help others with their personal problems_56"
        ,"Meet important educators or therapists_57"
        ,"Read Psychology Books or Articles_58"
        ,"Read Sociology Articles or Books_59"
        ,"Study juvenile delinquency_60"
        ,"Supervise activities for mentally ill patients_61"
        ,"Take a Human Relations course_62"
        ,"Teach adults_63"
        ,"Teach in a high school_64"
        ,"Work as a volunteer_65"
        ,"Work for a charity_66"
    ],

    "orderNumbers": [
         2
        ,29
        ,21
        ,32
        ,56
        ,41
        ,17
        ,57
        ,14
        ,11
        ,19
        ,64
        ,26
        ,33
        ,37
        ,59
        ,63
        ,10
        ,54
        ,30
        ,62
        ,66
        ,52
        ,7
        ,39
        ,1
        ,65
        ,20
        ,58
        ,44
        ,43
        ,45
        ,5
        ,15
        ,42
        ,35
        ,34
        ,46
        ,36
        ,49
        ,47
        ,24
        ,22
        ,50
        ,25
        ,61
        ,51
        ,60
        ,40
        ,23
        ,13
        ,3
        ,6
        ,8
        ,12
        ,55
        ,38
        ,4
        ,27
        ,53
        ,16
        ,28
        ,48
        ,31
        ,18
        ,9
    ],
    "totalMovement": 0,
    "lastTransformValue": 0,
    "bankedMovement": 0,
    "animationSpeed": 100,
    "currentIntervalID": null,
    "currentSpeed": 33,
    "cloudDuration": 250000,
    "moveRate": 3	 //3
};


/*



 ----------------------------- BALLOONS






 */

var Balloons = {
    "initSection": function(){
        console.log("balloons");
        // 1. Init copy
        this.initCopy();

        // 2. Init interface
        this.initInterface();
    },
    "initCopy": function(){
        $('.sectionCopyIntro').html(copy.section22ActiveInstructions);
    },
    "initInterface": function(){
        var that = this;

        cloudTracker.set('selectionString', cloudTracker.get('selectionString') + '</pictures>');
        //cloudTracker.set('changeString', cloudTracker.get('changeString') + '</speed><balloon1>');
        cloudTracker.resetElapsedTimerForBalloons();

        // Containing div
        var containerDiv = '<div class="balloonContainer"></div>';
        $('.section').append(containerDiv);

        $('.section').append('<div class="balloonNextCon"><div class="balloonNext">Next</div></div>');
        // Next button clicked
        $('.balloonNext').click(function(){

            console.log('BALLOON NEXT CLICKED');

            if(that.currentSection <= 1){
                cloudTracker.set('balloonTimingString', cloudTracker.get('balloonTimingString') + '</balloon' + that.currentSection + '><balloon'+ (that.currentSection + 1) + '>');
                that.setBalloonValues();
                ProgressBar.setProgress(-25);

                that.currentSection++;
                that.clearBalloons();
                that.createBalloons();
            } else {

                var loadingDiv = '<div id="loading"></div>';
                $('.section').append(loadingDiv);

                var target = document.getElementById("loading");
                var spinner = new Spinner({width: 4}).spin(target);

                ProgressBar.setProgress(0);
                cloudTracker.set('balloonTimingString', cloudTracker.get('balloonTimingString') + '</balloon' + that.currentSection + '>');
                that.setBalloonValues();
                that.clearBalloons();
                $('.sectionCopyContainer').html('');
                $('.balloonNextCon').html('');

                DataPipeline.sendCloudData(userID);
            }
        });

        this.createBalloons();
    },
    "createImage": function(iD){
        var img = new Image();

        $(img).load(function(){

            $('.bid'+iD).html(this);
            Helper.adjustHeight(this, true);

        }).attr('src', cloudsDir + this.picStrings[iD + (6 + (this.currentSection * 6))] + '.png');

    },
    "createBalloons": function(){
        var balloonLabels = "";
        var balloonDivs = "";
        var that = this;
        // Balloon divs
        for(var i = 0; i < 6; i++){

            balloonLabels += '<div class="balloonLabel" style="left:'+this.startingLefts[i]+'px"><p>' + this.itemTitles[i + ((this.currentSection - 1) * 6)] + '</p></div>';
            balloonDivs += '<div class="balloonDragger id' + (i+1) +'" style="left:'+(this.startingLefts[i] + 29)+'px"><div class="balloonAssets"><div class="balloonTop"><div class="balloonImage bid' + i+'"></div><div><img src="' + cloudsDir + "Balloon_" + this.balloonColors[i] + '.png"/></div></div><div class="balloonString"><img src="' + cloudsDir + "String_" + this.balloonColors[i] + '.png"/></div></div></div>';

            this.createImage(i);
        }

        $('.balloonContainer').append('<div class="balloonLabelContainer"></div>');
        $('.balloonLabelContainer').append(balloonLabels);
        $('.balloonContainer').append(balloonDivs);

        $('.balloonDragger').resizable({
            handles: "n",
            maxHeight: 600,
            minHeight: 200,
            aspectRatio: .27,
            resize: function(){
                // Keeps balloon centered
                var balloonID = $(this).attr('class').split('id')[1].split(' ')[0];
                $(this).css('left', ((162 - $(this).width()) / 2) + that.startingLefts[balloonID - 1]);
            },
            stop: function(){
                var balloonID = $(this).attr('class').split('id')[1].split(' ')[0];
                var newValue = that.getBalloonHeightAsPercentage($(this).height());

                cloudTracker.trackBalloonClick(balloonID, newValue);
            }
        });

        $('.balloonDragger').addTouch();
    },
    "setBalloonValues": function(){
        var that = this;

        cloudTracker.set('selectionString', cloudTracker.get('selectionString') + '<balloon' + this.currentSection +'>');

        $.each($('.balloonDragger'), function(index, val){
            cloudTracker.set('selectionString', cloudTracker.get('selectionString') + '<set' + (index + 1)+'>' + that.getBalloonHeightAsPercentage($(val).height()) + '</set' + (index + 1) + '>');
            //balloonValues.push(that.getBalloonHeightAsPercentage($(val).height()));
        });

        cloudTracker.set('selectionString', cloudTracker.get('selectionString') + '</balloon' + this.currentSection +'>');

        console.log(cloudTracker.get('selectionString'));

    },
    "getBalloonHeightAsPercentage": function(balloonPixelHeight){
        var percentValue = Math.floor((((balloonPixelHeight - 200) * 100) / 400));

        // Height: 600 - 200 = 400 * 100 = 40,000 / 400 = 100
        // Height: 300 - 200 = 100 * 100 = 10,000/ 400 = 25

        return percentValue;
    },
    "clearBalloons": function(){
        $('.balloonContainer').html("");
    },
    "picStrings": [ // Used by the preloader as well as the final loading of the photo URLs (Hands-Clerical)
        "String_Red"
        ,"Balloon_Red"
        ,"String_Green"
        ,"Balloon_Green"
        ,"String_Blue"
        ,"Balloon_Blue"
        ,"String_Pink"
        ,"Balloon_Pink"
        ,"String_Yellow"
        ,"Balloon_Yellow"
        ,"String_White"
        ,"Balloon_White"
        ,"Hands"
        ,"Math"
        ,"Music"
        ,"Understanding_Others"
        ,"Managerial"
        ,"Office"
        ,"Mechanical"
        ,"Science"
        ,"Artistic"
        ,"Teaching"
        ,"Sales"
        ,"Clerical"],
    "currentSection": 1,
    "balloonColors": ["Red", "Green", "Blue", "Pink", "Yellow", "White"],
    "itemTitles": ["Working With My Hands", "Math Ability", "Musical Ability", "Understanding of Others", "Managerial Skills", "Office Skills", "Mechanical Ability", "Scientific Ability", "Artistic Ability", "Teaching Ability", "Sales Ability", "Clerical Ability"],
    "startingLefts": [0, 166, 332, 498, 664, 830]
};

var DataPipeline = {
    "sendFrameData": function(userID){
        // Finalize XML string
        tracker.set('selectionString', tracker.get('selectionString') + '</pairs>');
        var finalXMLString = tracker.get('selectionString') + tracker.get('changeString') + '</frames>';
        $.ajax({
            type: 'POST',
            url: '../Posts/PostFrames.php',
            data: {data: finalXMLString, ID: userID},
            success: function(){ console.log("SUCCESSFUL DATA SEND")},
            error: function(XMLHttpRequest, textStatus, errorThrown){
                alert("there was an error1 "+XMLHttpRequest.responseText);
                alert("there was an error2 "+textStatus);
                alert("there was an error3 "+errorThrown);},
            dataType: 'xml'
        });
        //alert("user id is " + userID);
        console.log(':::' + finalXMLString + ':::');
    },
    "sendCloudData": function(userID){
        cloudTracker.set('changeString', cloudTracker.get('changeString') + cloudTracker.get('speedTimingString') + "</speed>" + cloudTracker.get('cloudTimingString') + "</clouds>" + cloudTracker.get('balloonTimingString') + '</changes>');
        var finalXMLString = '<clouds>' + cloudTracker.get('selectionString') + cloudTracker.get('changeString') + '</clouds>';

        $.ajax({
            type: 'POST',
            url: '../Posts/PostClouds.php',
            data: {data: finalXMLString, ID: userID},
            success: function(){  window.location.replace("../Delta/Animation/Animation.php"); },
            error: function(XMLHttpRequest, textStatus, errorThrown){
                alert("there was an error1 "+XMLHttpRequest.responseText);
                alert("there was an error2 "+textStatus);
                alert("there was an error3 "+errorThrown);},
            dataType: 'xml'
        });

        console.log(finalXMLString);
    }
};

var ProgressBar = {
    "addProgress": function(amt){
        var currentWidth = parseInt($('.progressBar').css('background-position').split('px ')[0], 10);
        $('.progressBar').css('background-position', (currentWidth + amt) +'px 0px');
    },
    "setProgress": function(amt){
        $('.progressBar').css('background-position', amt+'px 0px');
    }
};

var Helper = {
    "adjustHeight": function(ele, percentageAdjust){

        var hi = $(ele).height();

        if(percentageAdjust){
            if(hi < 80){
                var marg = (80 - hi) / 2;
                $(ele).css('margin-top', marg);
            }
        }
        else {
            if(hi < 265 && hi !== 0){
                var diff = 265 - hi;
                $(ele).css('margin-top', diff / 2);
            }
        }
    },
    "randomNum": function(minValue,maxValue){
        return Math.floor(Math.random() * (maxValue - minValue + 1)) + minValue;
    },
    "buildAssetArrays":function(){
        // Build asset arrays
        // SECTION 1
        for(var i = 0; i < Frames1.totalSections; i++){
            for(var j = 0; j < 5; j++){
                fr1AssetPaths.push(framesDir + 'F'+ (i+1) + Helper.letterIDs[j] + '.jpg');
            }
        }

        // SECTION 2
        for(var k = 0; k < Frames2.totalPairs; k++){
            fr2AssetPaths.push(framesDir + 'P' + (k+1) +'a.jpg');
            fr2AssetPaths.push(framesDir + 'P' + (k+1) +'b.jpg');
        }

        // SECTION 3
        for (var m = 0; m < Clouds.picStrings.length; m++) {
            c1AssetPaths.push(cloudsDir + "Numbers/" + (m+1) + ".jpg");
        }

        // SECTION 4
        for (var n = 0; n < Balloons.picStrings.length; n++){
            c2AssetPaths.push(cloudsDir + Balloons.picStrings[n] + ".png");
        }
    },
    "matrixToArray": function(matrix) {
        return matrix.substr(7, matrix.length - 8).split(', ');
    },
    "letterIDs": ["a", "b", "c", "d", "e"]
};

function imageLoaded(ref) {
    $(ref).trigger('photoLoad', ref);
}

function revertDroppedToOrigPosition(oldItemToMove){
    var target = $('.'+oldItemToMove).parent();
    target.trigger('setIsFrame', false);
    target.css('position', 'absolute');
    target.css('width', 150);
    target.css('height', 150);

    $('.'+oldItemToMove).css('border', '2px solid #000');

    // Get original left value
    var pID = target.attr('id').split('photo')[1];
    target.css('top', 0);
    target.css('left', Frames1.photoPositions[pID-1]);
}

// Tablet zoom settings
window.onorientationchange = function() {
    viewport = document.querySelector("meta[name=viewport]");
    if (window.orientation == 90 || window.orientation == -90) {
        viewport.setAttribute('content', 'width=device-width; initial-scale=0.84; user-scalable=0');
    } else {
        viewport.setAttribute('content', 'width=device-width; initial-scale=0.7; user-scalable=0');
    }
};
