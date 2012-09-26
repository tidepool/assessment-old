package 
{
	import flash.display.Sprite;
	import flash.ui.Keyboard;
	import flash.utils.getTimer;
	import flash.net.*;
	import flash.events.*;
	import flash.external.*;
	
	public class Main extends Sprite 
	{
		public var screens:Array = new Array();
		public var index:int;
		public var strings:Array = new Array();
		public var stringsSort:Array = new Array();
		public var stringsSelected:Array = new Array();
		public var xmlString:String;
		public var prefix:String;
		public var changesString:String;
		public var taskTime:Number;
		public var timeDiff:Number;
		private var ID:String;
		
		public function Main():void 
		{
			if (stage) init();
			else addEventListener(Event.ADDED_TO_STAGE, init);
		}
		
		private function init(e:Event = null):void 
		{
			removeEventListener(Event.ADDED_TO_STAGE, init);
			if (ExternalInterface.available) 
			{
				ExternalInterface.addCallback("recieveID", setID);
				ExternalInterface.call("getID", " ");
				var preLoader:Preloader = new Preloader(this);
			}
			prefix = "";
		
			run();
		}
		
		
		public function run():void
		{
			
			addEventListener(Event.ENTER_FRAME, update);
			
			//	screens.push(new screen0Text(this,""));
			index = 0;
			xmlString = "<beach>";
			xmlString += "<hands>";
			
			
			screens.push(new TextScreen(this,"You had many vivid dreams last night with little sound sleep. You are still groggy when you realize it’s time to get ready. You hope no one notices at the company picnic. As the director of the picnic, you must oversee all the activities. First you need to prepare the food.  But then you realize there are no utensils or plates. As you take charge your mind begins to wander. You are reminded of your lack of sleep. You think about this challenge as well as others in your past."));
			screens.push(new Picnic(this,"I am usually able to adapt to change","assets/Picnic/food1.png","change"));
			screens.push(new Picnic(this,"It is easy to adapt to changing circumstances","assets/Picnic/food2.png","challenge"));
			screens.push(new Picnic(this,"I tend to bounce back after hard times","assets/Picnic/food3.png","bounce"));
			screens.push(new Picnic(this,"I can make the best of any situation","assets/Picnic/food4.png","best"));
			screens.push(new Picnic(this,"I can reach deep within myself for strength when needed","assets/Picnic/food5.png","deep"));
			screens.push(new Picnic(this,"There are reasons for hope in life","assets/Picnic/food6.png","hope"));
			screens.push(new Picnic(this,"Failures are an opportunity for growth","assets/Picnic/food7.png","failure"));
			screens.push(new Picnic(this, "I find humor in much of my life", "assets/Picnic/food8.png","humor"));
			
			screens.push(new TextScreen(this, "You stop daydreaming long enough to see that someone found the missing plates and utensils. Now everyone is enjoying their food so you begin setting up the activities. Next is the Tug of War. Teams gather at either end of the rope. Being the helpful director you jump in. The war begins. Your hands are burning red as your feet slowly shift toward the opposite side. Searching for strength you ponder."));
			screens.push(new TugOfWar(this, "I can stay focused",
			"assets/TugOfWar/I can stay focused/Not really.jpg",
			"assets/TugOfWar/I can stay focused/Sometimes.jpg",
			"assets/TugOfWar/I can stay focused/Most of the time.jpg",
			"Not really","Sometimes","Most of the time"	,600,"focus"));			
			screens.push(new TugOfWar(this, "I finish what I start",
			"assets/TugOfWar/I finish what I start/Not really.jpg",
			"assets/TugOfWar/I finish what I start/Sometimes.jpg",
			"assets/TugOfWar/I finish what I start/Most of the time.jpg",
			"Not really","Sometimes","Most of the time"	,800,"finish"));			
			screens.push(new TugOfWar(this, "I will not be deterred from reaching my goal",
			"assets/TugOfWar/I will not be deterred from reaching my goal/I do not have this attitude.jpg",
			"assets/TugOfWar/I will not be deterred from reaching my goal/I sometimes have this attitude.jpg",
			"assets/TugOfWar/I will not be deterred from reaching my goal/I have this attitude.jpg",
			"I do not have this attitude", "I sometimes have this attitude", "I have this attitude",1000,"deter"));
			
			screens.push(new TextScreen(this, "Your team lost. Your mind was somewhere else during the competition. But now you must coordinate for those who are going to surf. As you watch you find yourself daydreaming about your memories on the beach when you were younger. You think to yourself."));
			screens.push(new SurfSelect(this));			
			screens.push(new SurfMulti(this));
			
			screens.push(new TextScreen(this, "With a newfound sense of self-understanding you get your peers together for the most anticipated event of the picnic: the scavenger hunt. But it’s happening again. Sleepwalking through the scavenger hunt you are deep in thought. As your team accomplishes each task you answer these questions to yourself."));
			screens.push(new Select2(this, "assets/SeaShells/1/",
			"I laugh often",
			"True", "False", 
			"assets/SeaShells/Bucket-empty.png", "assets/SeaShells/Bucket-1-shell.png","laugh"));			
			screens.push(new Select2(this, "assets/SeaShells/2/",
			"I have little time for pleasure",
			"True", "False", 
			"assets/SeaShells/Bucket-1-shell.png", "assets/SeaShells/Bucket-1-shell&rock.png","pleasure"));			
			screens.push(new Select3(this, "assets/SeaShells/3/",
			"Select all that are true for you",
			"1", "2","3", "I find I don’t need close friends","I usually don’t stay friends with people for very long periods of time","I prefer friends who are exciting and unpredictable",
			"assets/SeaShells/Bucket-1-shell&rock.png", "assets/SeaShells/Bucket-2shell&2rock.png"));			
			screens.push(new Select3(this, "assets/SeaShells/4/",
			"Select all that are true for you.",
			"1", "2","3", "I have a hard time understanding other people’s feelings","My friends and family tell me I don’t understand them","I feel supported by my friends",
			"assets/SeaShells/Bucket-2shell&2rock.png", "assets/SeaShells/Bucket-2shell&3rock.png"));			
			screens.push(new Select4(this, "assets/SeaShells/5/",
			"Overall, how supportive do you find your friends to be?",
			"Very supportive", "Somewhat supportive", "Not really supportive", "Not supportive at all", 
			"assets/SeaShells/Bucket-2shell&3rock.png", "assets/SeaShells/Bucket-4shell&4rock.png"));			
			screens.push(new Select5(this, "assets/SeaShells/6/",
			"How many friends do you have with whom you make contact at least once a month?",
			"0", "1-2", "3-4", "5-6", "7+",
			"assets/SeaShells/Bucket-4shell&4rock.png", "assets/SeaShells/Bucket-5shell&5rock.png"));
			
			screens.push(new TextScreen(this, "You are nearly finished when you realize you are way behind. You come back to reality. You need to choose between running to the beach to take a picture with the lifeguard or running to the park to take a picture near the Ferris wheel."));
			screens.push(new PlacesSelect(this));
			
			screens.push(new PlacesTrueFalse(this, "assets/Places/path1.jpg","Acting quickly is more important than considering every option"));
			screens.push(new PlacesTrueFalse(this, "assets/Places/path2.jpg","People tell me I make decisions too quickly"));
			
			screens.push(new TextScreen(this, "The day is over. People begin packing up and one by one they leave the picnic. Everyone has left when you sit alone on the sand replaying the events of the day."));
			
			screens.push(new PlacesSliderScreen(this, "I am able to remember facts and information that I need for my work.", "assets/Places/1.jpg", "slider1"));
			screens.push(new PlacesSliderScreen(this, "I take pleasure in the quality of my work.", "assets/Places/2.jpg", "slider2"));
			
			screens.push(new TextScreen(this, "As you look into the distance you see a message in a bottle wash on the shore. You run towards it, uncork the bottle and unravel the paper. It is a poem."));
			
			screens.push(new PoemSliderScreen(this, "", "Poems don’t make sense to me. They’re not my thing", "I appreciate a good poem now and then.", "Poetry is an art form that should be appreciated and cherished","poem"));
			screens.push(new PoemSliderScreen(this, "Do you usually enjoy arts such as theater and poetry?", "Yes", "Sometimes", "No", "art"));
			
			screens.push(new TextScreen(this, "You stand up with the bottle in your hand. You look around for a spot to place it. You see a nearby TidePool and decide to place the treasure there, ready to be picked up by the next explorer."));
			
			screens.push(new EndScreen(this));
			
			changesString = "<changes><picnic>";
			screens[index].render();
		}
		public function update(e:Event):void
		{
			if (index < screens.length)
			{
				screens[index].update();
			}
		}
		
		
		public function displayNext():void
		{
			timeDiff = getTimer() - taskTime;
			screens[index].writeXML();
			//trace(xmlString);
			index++;
			
			if (index == 10)
			{
				changesString += "</picnic>";
				changesString += "<tug>";
				xmlString += "</hands>";
				xmlString += "<tug>";
			}
			if (index == 28)
			{
				changesString += "</places>";
				xmlString += "</places>";
			}
			if (index >= screens.length)
			{
				if (parent.parent != null )
				{
					parent.parent.removeChild(parent);
				}
			}
			else
			{
				graphics.clear();
				while (numChildren > 0)
				{
					removeChildAt(0);
				}
				screens[index].render();
			}			
			trace(changesString);
		}
		
		public function setID(id):void
		{
			ID = id;
		}
		
		public function postData():void
		{
			
			var xmlURLReq:URLRequest = new URLRequest("http://www.tidepool.co/Posts/PostBeach.php");				
			var phpVariables:URLVariables = new URLVariables();
			phpVariables.data = xmlString;
			//ID = "alwhrwrafdeegnel";
			phpVariables.ID = ID;	
			xmlURLReq.data = phpVariables;
			xmlURLReq.method = URLRequestMethod.POST; 
			var xmlSendLoad:URLLoader = new URLLoader(); 
			xmlSendLoad.addEventListener(Event.COMPLETE, onComplete, false, 0, true); 
			xmlSendLoad.addEventListener(IOErrorEvent.IO_ERROR, onIOError, false, 0, true); 
			xmlSendLoad.load(xmlURLReq); 
		}
		
		private function onComplete(evt:Event):void 
		{     
			try 
			{         
				//xmlResponse = new XML(evt.target.data);  
				var temp:String = evt.target.data;
				trace(temp);         
				if (temp == "complete")
				{
					makeCall();
				}
				removeEventListener(Event.COMPLETE, onComplete);         
				removeEventListener(IOErrorEvent.IO_ERROR, onIOError);     
			} 
			catch (err:TypeError) 
			{         
				trace("An error occured when communicating with server:\n" + err.message);     
			}     
		} 
		
		private function onIOError(evt:IOErrorEvent):void 
		{     
			trace("An error occurred when attempting to load the XML.\n" + evt.text);  
		} 
		
		public function makeCall():void
		{
			if (ExternalInterface.available) {
                ExternalInterface.call("sendToJavaScript", xmlString);
            }
		}
		
	}
	
}