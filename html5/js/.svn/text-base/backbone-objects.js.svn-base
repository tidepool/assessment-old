/*==========================================
============================================
|| Section 1.1
============================================
==========================================*/
/*==========================================
|| BACKBONE OBJECTS
==========================================*/

// Photo class
var Photo = Backbone.Model.extend({
	defaults:{
		imageURL: 'null',
		photoConID: 0,
		isInFrame: false,
		isLoaded: false,
		imageHeight: 0,
		marginTop: 0,
		startedDragging: false

	}
});

// PhotoView class
var PhotoView = Backbone.View.extend({
	className: 'photo',
	events: {
		"mousedown": "mouseDown",
		"mouseup": "mouseUp",
		"drop": "drop",
		"photoLoad": "photoLoad",
		"getHeight": "getHeight",
		"setIsFrame": "setIsFrame"
	},
	setIsFrame: function(event, isFrame){
		this.model.set('isInFrame', isFrame);
	},
	getHeight: function(){
		Frames1.selectedFrameHeight = this.model.get('imageHeight');
	},
	photoLoad: function(event, item){
		var loaded = this.model.get('isLoaded');
		if(!loaded){
			// Make visible
			$(item).css('display', 'block');

			// Adjust parent's margin-top to center vertically
			var parent = $(item).parent();
			var imgHeight = $(item).height();
			var adjust = Math.abs((imgHeight / 2) - 75);

			this.model.set('imageHeight', imgHeight);
			this.model.set('isLoaded', true);
			this.model.set('marginTop', adjust);

			$(parent).css('margin-top', adjust);
		}
	},
	initialize: function(){
		this.render();
	},
	drop: function(event, inFrame){

		this.model.set('isInFrame', inFrame);
		if(inFrame === true){
			var img = this.$el.children();
			img.css('border', 'none');

			this.$el.css('margin-top', this.model.get('marginTop'));
			this.$el.css('margin-left', 0);
		}
		else {
			//console.log('PhotoView::drop:: setting border none');
			var im = this.$el.children();
			im.css('border', '2px solid #000');
		}
		
	},
	mouseUp: function() {
		
		if(this.model.get('startedDragging')){
		
			this.model.set('startedDragging', false);
		}else {
			// Mouse up with startedDragging false means item was clicked but not dragged
			var photoID = this.$el.attr('id');
			var letterID = Helper.letterIDs[photoID.split('photo')[1] - 1];
			tracker.set('changeString', tracker.get('changeString') + '^' + letterID);
			tracker.trigger('trackTime');
		}
	},
	mouseDown: function() {
		// Returns a "a", "b", "c" etc., based on element ID
		Frames1.preMouseUpData = Frames1.pf.get('occupied');

		var photoID = this.getLetterID(this.$el.attr('id'));
		
		tracker.trigger('trackClick', photoID);
		tracker.trigger('trackTime');

		if(this.$el.css('position') === 'static') {
			this.$el.css('position', 'absolute');
		}
	},
	template: _.template('<img onload="imageLoaded(this)" class="<%= photoID %>" src="<%= imageURL %>">'),
	render: function(){
		var that = this;
		this.$el.html(this.template(this.model.toJSON()));
		this.$el.draggable({
			revert: 'invalid',
			revertDuration: 200,
			containment: '.container',
			zIndex: 20,
			start: function(event, ui){
				that.model.set('startedDragging', true);
			},
			stop: function(event, ui){
				
				var photoID = $(this).attr('id');
				var letterID = Helper.letterIDs[photoID.split('photo')[1] - 1];

				// Add change to changeString
				tracker.set('changeString', tracker.get('changeString') + '^' + letterID);

				// Was there a change?
				if(Frames1.arraysEqual(Frames1.preMouseUpData, Frames1.pf.get('occupied'))){
					
					// Arrays match - no change
					tracker.trigger('trackTime');
				}
				else {
					
					tracker.trigger('trackChange', Frames1.pf.get('occupied'));
				}
			}
		});

		var ref = this;

		this.$el.hover(function(){
			
			var isInFrame = ref.model.get('isInFrame');
			if(!isInFrame){
				var currTop = $(this).css('margin-top').split('px');
				var currLeft = $(this).css('margin-left').split('px');

				$(this).css('margin-top', currTop[0] - 10);
				$(this).css('margin-left', currLeft[0] - 10);
				
				$(this).width(170);
				$(this).height(170);
			}else {
				var child = $(this).children();
				child.css('border', '2px solid #000');
			}
			
		}, function(){

			var isInFrame = ref.model.get('isInFrame');
			if(!isInFrame){
				$(this).css('margin-top', ref.model.get('marginTop'));
				$(this).css('margin-left', 0);

				$(this).width(150);
				$(this).height(150);
			}else {
				var child = $(this).children();
				child.css('border', 'none');
				
			}
		});
	},
	getLetterID: function(photoID){
		return Helper.letterIDs[photoID.split('photo')[1] - 1];
	}
});

// Photo collection
var PhotoList = Backbone.Collection.extend({
	model: Photo
});

// Collection view
var PhotoRowView = Backbone.View.extend({
	id: "photoRowView",
	// Collection Views do the rendering
	clearView: function(){
		this.$el.html('');
	},
	render: function(){
		this.collection.forEach(this.addOne, this);
	},
	addOne: function(model){
		Frames1.photoConID++;
		
		// Photo con ID for CSS styling
		var photoView = new PhotoView({model: model, id: 'photo'+Frames1.photoConID});
		this.$el.append(photoView.el);
	}
});

// Photo frame model. One to many relationship with PhotoFrameViews and ExtendedDragArea
var PhotoFrameModel = Backbone.Model.extend({
	initialize: function(){
		this.bind('change:occupied', function(){
			// Check how many nones
			var currOccu = this.get('occupied');

			var numNones = 0;
			for (var i = 0; i < currOccu.length; i++) {
				if(currOccu[i] === '0'){
					numNones++;
				}
			}

			if(numNones <= 0){
				// No nones! Show trashcan
				Frames1.trashIsShowing = true;
				$('#trashCan').fadeIn(300);
				$('.sectionCopyEnd').fadeIn(300);
			}
			else {
				if(Frames1.trashIsShowing){
					Frames1.trashIsShowing = false;
					$('#trashCan').fadeOut(300);
					$('.sectionCopyEnd').fadeOut(300);
					// Hide trash
				}
			}

		});
	},
	defaults: {
		occupied: ['0', '0', '0', '0']
	}
});


// PhotoFrameViews use one model (PhotoFrameModel)
var PhotoFrameView = Backbone.View.extend({
	initialize: function(){
		this.render();
	},
	render: function(){
		this.$el.droppable({
			drop: _.bind(this._onDrop, this),
			hoverClass: 'hoverState'
		});
	},
	_onDrop: function(events, ui){
		var thisID = this.id.split('frame')[1];
		var extSplit = thisID.split("_");
		var isExtended = extSplit[0] === 'Extended' ? true : false;

		// The photo dropped - relevant properties
		var item = ui.draggable;
		var htmlEl = $(item).html();
		var photoIdentifier = $(htmlEl).attr('class');

		// Update frames model. Tell it which frame and which photo
		// Get 'occupied' array
		// Make copy of it (newOccupation)
		var origOccupation = this.model.get('occupied');
		var newOccupation = origOccupation.slice(0);
		
		// Check to see if item existed elsewhere in a frame.
		// If it exists elsewhere, it means that the photo dropped
		// is going from one frame to another. Set its old frame value
		// to none
		var numItems = origOccupation.length;

		for (var i = 0; i < numItems; i++) {
			if(origOccupation[i] === photoIdentifier){
				// It exists elsewhere in the array, so set it to none
				newOccupation[i] = '0';
			}
		}

		// Check to see if frame was already occupied, if so, return it to original position

		// If the position we're moving into already has a value other than none,
		// that means another photo occupied the frame already.
		// Check to see if/what photo occupied the frame so we can
		// move it later
		if(isExtended){
			revertDroppedToOrigPosition(photoIdentifier);
			this.model.set('occupied', newOccupation);
		}
		else{
			var oldItemToMove = 'null';

			// Checks to see if dropping on an already occupied spot
			if(newOccupation[thisID-1] !== '0'){
				
				oldItemToMove = newOccupation[thisID-1];
				revertDroppedToOrigPosition(photoIdentifier);
				isExtended = true;
				this.model.set('occupied', newOccupation);
			}
			else {
				// Set new occupation
				newOccupation[thisID-1] = photoIdentifier;
				this.model.set('occupied', newOccupation);
			}
		}

		

		if(isExtended){
			ui.draggable.trigger('drop', false);
			// return;
		}
		else {
			ui.draggable.trigger('drop', true);
			Frames1.sizePhotoInFrame(item, this.id);
		}
	}
});

var TrashCanView = Backbone.View.extend({
	className: 'trashHitArea',
	initialize: function(){
		this.render();
	},
	render: function(){
		this.$el.droppable({
			drop: _.bind(this._onDrop, this)
		});
	},
	_onDrop: function(events, ui){
		// The photo dropped - relevant properties
		var item = ui.draggable;
		var htmlEl = $(item).html();
		var photoIdentifier = $(htmlEl).attr('class');

		// Look for the item dropped on TrashCan in the PhotoFrameModel -
		// If it's in there, cancel the trash can drop

		var droppedItemIsComingFromAFrame = false;
		var frameID = 0;

		var origOccupation = this.model.get('occupied');
		
		for (var i = 0; i < origOccupation.length; i++) {
			if(origOccupation[i] === photoIdentifier){
				droppedItemIsComingFromAFrame = true;
				
				frameID = i;
			}
		}

		if(droppedItemIsComingFromAFrame){
			// Coming from a frame - put it back
			Frames1.sizePhotoInFrame(item, 'frame'+(frameID+1));

		}else {
			// Not coming a frame (meaning it was the last photo on the bottom row)
			// Start a new section
			//Frames1.tracker.
			
			tracker.trigger("addSelection", {occu: origOccupation, currSection: Frames1.currentSection, totalSections: Frames1.totalSections, trashed: photoIdentifier });
			tracker.trigger("endSection", {pId: photoIdentifier, occu: origOccupation});
			Frames1.newSection();
		}
	}
});