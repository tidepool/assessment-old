package  
{
	import flash.display.Sprite;
	import flash.events.Event;
	import flash.utils.getTimer;
	/**
	 * ...
	 * @author Wei
	 */
	public class List 
	{
		public var main:Main;
		
		public var positionX:Number;
		public var positionY:Number;
		
		public var itemsList:Array = new Array();
		
		public var bar:ScrollBar;
		
		public var timer:int;
		public var index:int = -1;
		
		public var sprite:Sprite = new Sprite();
		
		public var width:Number = 500;
		public var height:Number = 100;
		
		private var showOneByOne:Boolean = false;
		
		public var currHeight:Number = 100;
		public var screenHeight:Number = 700;
		
		public var isShown:Boolean = true;
		
		
		public var selectedURL:String="";
		
		public function List(p_main:Main,px:Number,py:Number,w:Number,h:Number) 
		{
			main = p_main;
			positionX = px;
			positionY = py;
			width = w;
			height = h;
			
			timer = -9999;
			bar = new ScrollBar(main,this, positionX + width - 38, 68, 714);
			
			main.addChild(sprite);
			
			main.stage.addEventListener(Event.ENTER_FRAME, update);
		}
		
		
		
		public function addItem(data:UserData):void
		{
			if (itemsList.length > 0)
			{
				itemsList.push(new ListItem(sprite,this,positionX,positionY-(itemsList.length-1)*height,data.name,data.pictureURL,data.company,data.workType,data.description,data.cloud,data.frames,data.space) );
			}
			else
			{
				itemsList.push(new ListItem(sprite,this,positionX,positionY-(itemsList.length)*height,data.name,data.pictureURL,data.company,data.workType,data.description,data.cloud,data.frames,data.space) );
			
			}
		}
		
		public function addAd(language:String,link:String):void
		{
			itemsList.push(new Advertisement(sprite,this,positionX,positionY-(itemsList.length-1)*height,language,link));
		}
		
		public function addCompany(name:String,url:String,description:String,link:String):void
		{
			itemsList.push(new Company(sprite,this,positionX,positionY+itemsList.length*height,name,url,description,link));
		}
		
		/*
		public function addItem(p_name:String,p_url:String,p_worktype:String,p_cloud:Number=1,p_frames:Number=1,p_space:Number=1):void
		{
			itemsList.push(new ListItem(main,this,positionX,positionY+itemsList.length*100,p_name,p_url,p_worktype,p_cloud,p_frames,p_space) );
		}*/
		
		public function showAll():void
		{
			for (var i:int = 0; i < itemsList.length; i++ )
			{
				itemsList[i].show();
			}
		}
		
		public function setScale(w:Number,h:Number):void
		{
			width = w;
			height = h;
		}
		
		public function show():void
		{
			showOneByOne = true;
		}
		
		public function update(e:Event=null):void
		{
			if (index <= itemsList.length-2)
			{
				if (showOneByOne)
				{
					if (getTimer()-timer > 3000)
					{
						timer = getTimer();					
						index++;
						
						if (index < itemsList.length)
						{
							itemsList[index].show();
						}
						for (var i:int = 1; i < itemsList.length; i++)
						{
							if (itemsList[i].shown)
							{
								itemsList[i].applyOffset(height * (index));
							}
						}
					}
				}
			}
			/*
			if (index > itemsList.length - 1)
			{
				index = itemsList.length - 1;
			}
			*/
			var totalLength:Number = (index + 1) * height;
			currHeight = totalLength;
			var totalOffset:Number = totalLength - screenHeight;
			if (totalOffset < 0)
			{
				return;
			}
			sprite.y = -bar.value*totalOffset;
		}
		
		public function hide():void
		{
			if (main.contains(sprite))
			{
				main.removeChild(sprite);
				isShown = false;
			}
		}
		
	}

}