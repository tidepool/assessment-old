var Tracker = Backbone.Model.extend({
	initialize: function(){
		// Start timer
		this.on('trackClick', this.trackClick);
		this.on('trackChange', this.trackChange);
		this.on('trackTime', this.trackTime);
		this.on('endSection', this.endSection);
		this.on('addSelection', this.addSelection);

		this.on('change:changeString', function(){
			//console.log(this.get('changeString'));
		});

		this.on('change:selectionString', function(){
			//console.log(this.get('selectionString'));
		});

		this.set('time', new Date().getTime());
		this.set('startTime', this.get('time'));
		this.set('taskTime', this.get('time'));
		//console.log("start time: "+this.get('startTime'));
		this.tick();
	},
	defaults: {
		elapsed: 0,
		startTime: null,
		taskTime: 0,
		time: null,
		timeSinceGrab: null,
		changeString: "<changes><frames1><set1>",
		changeTime: 0,
		selectionString: "<frames><sets><set1>"
	},
	addSelection: function( data ){
		// Add selections to selection string

		var addedItems = "";
		for(var i = 0; i < 5; i++){
			if(i < 4) addedItems += "<choice"+(i+1)+">"+data.occu[i]+"</choice"+(i+1)+">";
			else addedItems += "<choice"+(i+1)+">"+data.trashed+"</choice"+(i+1)+">";
		}
		if((data.currSection +1) !== data.totalSections){
			addedItems += "</set"+(data.currSection+1)+"><set"+(data.currSection+2)+">";
		}
		else {
			addedItems += "</set"+(data.currSection+1)+"></sets><pairs>";
		}

		this.set("selectionString", this.get("selectionString") + addedItems);
		//console.log(this.get("selectionString"));
		
		//console.log(addedItems);
	},
	addPair: function ( data ) {
		var addedItems = "<pair"+data.currPair+">"+data.selectedPair+"</pair"+data.currPair+">";
		this.set("selectionString", this.get("selectionString") + addedItems);
		//console.log(this.get("selectionString"));
	},
	tick: function(){
		var that = this;
		// setInterval() returns and integer ID of the "interval", so that you can later clearInterval(...) by passing this ID
		window.setInterval(function(){
			var time = new Date().getTime() - that.get('startTime');
			that.set('elapsed', time);
		}, 10);
	},
	trackTime: function(){
		var timeDiff = this.get('elapsed') - this.get('changeTime');
		//console.log(timeDiff);
		this.set('changeString', this.get('changeString') + '@' + timeDiff);
		this.set('changeTime', this.get('elapsed'));
	},
	trackChange: function(occupiedArray, trashed){
		// console.log('trackchange !');
		var arrayWithDashes = "";
		for (var i = 0; i < occupiedArray.length; i++) {
			arrayWithDashes += occupiedArray[i] + "-";
			if(i === (occupiedArray.length - 1)) {
				// Last item in string. Add a 0 or
				
				if(trashed !== undefined){
					arrayWithDashes += trashed;
				} else {
					arrayWithDashes += "0";
				}
			}
		}

		this.set('changeString', this.get('changeString') + '#' + arrayWithDashes);
		this.trackTime();
	},
	trackClick: function(photoID){
		this.set('changeString', this.get('changeString') + "*" +photoID);
	},
	endSection: function(data){
		this.set('changeString', this.get('changeString') + '^' + data.pId);
		this.trackChange(data.occu, data.pId);
	}

});

var CloudTracker = Backbone.Model.extend({
	initialize: function(){
		// Start timer
		this.on('trackSpeedChange', this.trackSpeedChange);
		this.on('trackCloudClick', this.trackCloudClick);

		this.on('change:changeString', function(){
			console.log(this.get('changeString'));
		});

		this.set('time', new Date().getTime());
		this.set('startTime', this.get('time'));
		this.set('speedTaskTime', 0);

		this.tick();
	},
	tick: function(){
		var that = this;

		window.setInterval(function(){
			var time = new Date().getTime() - that.get('startTime');
			that.set('elapsed', time);
			//console.log(that.get("elapsed"));
		}, 10);
	},
	"trackSpeedChange": function(speedID){
		this.set("speedTimingString",  this.get("speedTimingString") + "*" + speedID + "@" + (this.get("elapsed") - this.get("speedTaskTime")));
		//this.set("speedTaskTime", this.get("elapsed"));
		console.log(this.get("speedTimingString"));
	},
	"trackCloudClick": function(cloudID){
		this.set("selectionString", this.get("selectionString") + "<pic>" + cloudID + "</pic>");
        this.set("cloudTimingString", this.get("cloudTimingString") + cloudID + "@" + (this.get("elapsed") - this.get("speedTaskTime")));
		console.log(this.get("selectionString"));
        console.log(this.get("cloudTimingString"));
	},
	"resetElapsedTimerForBalloons": function(){
		console.log("REEEEEESSSEEEET");
		this.set('startTime', new Date().getTime());
		this.set('speedTaskTime', 0);
	},
	"trackBalloonClick": function(balloonClicked, valueSetTo){
		this.set('balloonTimingString', this.get('balloonTimingString') + '*' + balloonClicked + '-' + valueSetTo + '@' + (this.get("elapsed") - this.get("speedTaskTime")));
		this.set("speedTaskTime", this.get("elapsed"));
        console.log(this.get("balloonTimingString"));
	},
	defaults: {
		startTime: null,
		time: null,
		speedTaskTime: null,
		elapsed: 0,
		selectionString: "<pictures>",
		changeString: "<changes>",
        balloonTimingString: "<balloon1>",
        speedTimingString: "<speed>",
        cloudTimingString: "<clouds>"
	}
});