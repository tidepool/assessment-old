package  
{
	import flash.events.Event;
	import flash.events.MouseEvent;
	import flash.net.navigateToURL;
	import flash.net.URLRequest;
	/**
	 * ...
	 * @author Wei
	 */
	public class Advertisement 
	{
		
		public var main:Object;
		public var list:List;
		
		public var positionX:Number;
		public var positionY:Number;
		
		
		
		public var isOver:Boolean = false;
		public var isSelected:Boolean = false;
		public var lastOver:Boolean = true;
		public var lastSelected:Boolean = false;
		public var alpha:Number = 0;
		
		
		public var shown:Boolean = false;
		private var visible:Boolean = false;
		
		public var offset:Number = 0;
		
		
		public var language:String;
		public var link:String;
		
		private var languageLabel:Label;
		
		
		public function Advertisement(p_main:Object,p_list:List,px:Number,py:Number,p_language:String,p_link:String) 
		{
			main = p_main;
			list = p_list;
			positionX = px;
			positionY = py;
			language = p_language;
			link = p_link;
		}
		
		
		public function show():void
		{
			languageLabel = new Label(main, positionX - 20, positionY , language , 20, list.width-40, false);
			main.stage.addEventListener(MouseEvent.MOUSE_MOVE, move);
			main.stage.addEventListener(MouseEvent.CLICK, click);
			main.stage.addEventListener(Event.ENTER_FRAME, update);
			shown = true;
			visible = true;
		}
		
		
		public function applyOffset(o:Number):void
		{
			languageLabel.setPosition(positionX, positionY + o);
			offset = o;
			update();
		}
		
		public function update(e:Event=null):void
		{
			//if (lastOver != isOver || lastSelected != isSelected)
			{
				if (isOver)
				{
					alpha = 0.4;
					
				}
				else
				{
					alpha = 0;
				}
				
				var margin:Number = list.itemsList.length * 100 - 700;
				if (margin < 0)
				{
					margin = 0;
				}
				
			//	applyOffset( -list.bar.value / (list.bar.length - 57) * margin);
			//	applyOffset( -list.bar.value);
				
				var nameColor:uint;
				
				main.graphics.lineStyle();
				main.graphics.beginFill(0xffffff, 1);
				main.graphics.drawRect(positionX - list.height/2, positionY - list.height/2+offset, list.width, list.height);
				main.graphics.endFill();
					
				languageLabel.text.textColor = 0;
				
				main.graphics.beginFill(0x7925F7, 1);
				main.graphics.drawRect(positionX - list.height/2, positionY - list.height/2+offset, list.width, list.height);
				main.graphics.endFill();
				languageLabel.text.textColor = 0xFFFFFF;
				
				
				if (isOver)
				{
					main.graphics.beginFill(0x9553F9, 1);
					main.graphics.drawRect(positionX - list.height/2, positionY - list.height/2+offset, list.width, list.height);
					main.graphics.endFill();
					languageLabel.text.textColor = 0xFFFFFF;
					
				}
				if (isSelected)
				{
					main.graphics.beginFill(0x999999, 0.3);
					main.graphics.drawRect(positionX - list.height/2, positionY - list.height/2+offset, list.width, list.height);
					main.graphics.endFill();
					languageLabel.text.textColor = 0x1144FF;
				}
				
				
				main.graphics.lineStyle(1,0,0.2);
			//	main.graphics.beginFill(0, 0.01);
				main.graphics.moveTo(positionX - list.height / 2, positionY - list.height / 2 + offset);
				main.graphics.lineTo(positionX - list.height / 2+list.width, positionY - list.height / 2 + offset);
				main.graphics.lineStyle(1,0,0.2);
				main.graphics.moveTo(positionX - list.height / 2, positionY + list.height / 2 + offset);
				main.graphics.lineTo(positionX - list.height / 2+list.width, positionY + list.height / 2 + offset);
			//	main.graphics.endFill();
						
			}
			
			lastOver = isOver;
			lastSelected = isSelected;
		}
		
		public function click(e:Event):void
		{
			if (main.mouseX > positionX - list.height/2 && main.mouseX < positionX - list.height/2 + list.width && main.mouseY > positionY - list.height/2 +offset&& main.mouseY < positionY + list.height/2+offset)
			{
				for (var i:int = 0; i < list.itemsList.length; i++ )
				{
					list.itemsList[i].isSelected = false;
				}
				isSelected = true;
				main.graphics.clear();
				
				navigateToURL(new URLRequest(link),"_blank"); 
			}
		}
		
		public function move(e:Event):void
		{
			if (main.mouseX > positionX - list.height/2 && main.mouseX < positionX - list.height/2 + list.width && main.mouseY > positionY - list.height/2+offset && main.mouseY < positionY + list.height/2+offset)
			{
				isOver = true;
			}
			else
			{
				isOver = false;
			}
		}
	}

}