package  
{
	import flash.display.Sprite;
	import flash.events.*;
	import flash.net.*;
	import flash.external.*;
	/**
	 * ...
	 * @author Wei
	 */
	public class ComparePage 
	{
		
		public var main:Main;
		
		public var positionX:Number;
		public var positionY:Number;
		
		public var picture1:Picture;
		public var picture2:Picture;
		
		public var sprite:Sprite = new Sprite();
		public var compareSprite:Sprite = new Sprite();
		public var graphSprite:Sprite = new Sprite();
		
		private var compareButton:Button=null;
		private var graphButton:Button = null;
		
		private var graph:Graph;
		
		public var url:String;
		
		public var data:Array=new Array();
		
		public var status:int = 0;
		
		public var popup:PopupPage;
		
		private var comparativeText:Label;
		
		public function ComparePage(p_main:Main,px:Number,py:Number) 
		{
			main = p_main;
			positionX = px;
			positionY = py;
			
			picture1 = new Picture(compareSprite,positionX-100,positionY-100,"assets/tidepool.png",100);
			picture2 = new Picture(compareSprite,positionX+100,positionY-100,"assets/tidepool.png",100);
			graphButton = new Button(sprite, positionX + 150, positionY - 270, "Graph");
			graphButton.sprite.addEventListener(MouseEvent.CLICK, showGraph);
			
			compareButton = new Button(sprite, positionX - 150, positionY - 270, "Compare");
			compareButton.sprite.addEventListener(MouseEvent.CLICK, showCompare);
			
			createData();
			graph = new Graph(graphSprite,this, 850, 510, 700, 260);
			new GraphData(data, graph);
			
			graph.show();
			sprite.addChild(compareSprite);
			popup = new PopupPage(sprite, this);
			
			var temp:String = "You cool-headed leaders aren't afraid to tackle the high-stakes challenges that scare away your peers. In the office, you can handle stressful projects without getting overwhelmed. However, strict deadlines and high expectations may cause a rift between your opposing ambitious and easygoing natures. Socially, we recommend that you two skip the skydiving and instead kick back with low-key social activities.";
			comparativeText = new Label(compareSprite, positionX, positionY, temp, 14, 700, true);
		}
		
		private function createData() :void
		{
			for (var i:int = 0; i < main.users.length; i++ )
			{
				data.push(main.users[i]);
			}
			data.push(main.currentUser);
		}
		
		public function showPage():void
		{
			if (!main.contains(sprite))
			{
				main.addChild(sprite);
			}
			
		}
		
		public function showPopup(px:Number,py:Number,name:String):void
		{
			for (var i:int = 0; i < main.users.length; i++ )
			{
				if (main.users[i].name == name)
				{
					var posX:Number = px + 80;
					if (posX > 1400)
					{
						posX = 1400;
					}
					popup.show(posX,py-90,main.users[i].pictureURL,main.users[i].description)
				}
			}
		}
		
		public function hidePopup():void
		{
			popup.hide();
		}
		
		public function setData(p_url:String,type:String):void
		{
			url = p_url;
			
			picture2.loadNew(url,100);
			picture2.setPosition(positionX + 200, positionY - 150);
			picture1.setPosition(positionX - 200, positionY - 150);
			comparativeText.changeText(positionX, positionY, 16, "", 700);
			trace ("WT: " + type);
			GetComparativeText(type);
		}
		
		public function showCompare(e:Event=null):void
		{
			if (sprite.contains(graphSprite))
			{
				sprite.removeChild(graphSprite);
			}
			if (!sprite.contains(compareSprite))
			{
				sprite.addChild(compareSprite);
			}
		}
		
		public function showGraph(e:Event=null):void
		{
			if (sprite.contains(compareSprite))
			{
				sprite.removeChild(compareSprite);
			}
			if (!sprite.contains(graphSprite))
			{
				sprite.addChild(graphSprite);
			}
		}
		
		private function GetComparativeText(type:String):void
		{
			
			var xmlURLReq:URLRequest = new URLRequest("http://tidepool.co/Comparative/GetComparative.php");				
			var phpVariables:URLVariables = new URLVariables();
			//phpVariables.data = xmlString;
			//ID = 245232;
			phpVariables.user = main.currentUser.workType.substr(0, 2);	
			phpVariables.other = type;	
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
				comparativeText.changeText(positionX, positionY, 18, "\t"+temp, 700); 
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
	}

}