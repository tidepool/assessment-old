package  
{
	import flash.events.Event;
	import flash.geom.Point;
	/**
	 * ...
	 * @author Wei
	 */
	public class VerticalBar 
	{
		public var main:Main;
		public var positionX:Number;
		public var positionY:Number;
		public var width:Number = 30;
		public var value:Number;
		public var scale:Number=1.8;
		public var height:Number;
		
		public var p1:Point=new Point();
		public var p2:Point=new Point();
		public var p3:Point=new Point();
		public var p4:Point = new Point();
		
		public var color:uint;
		
		public var name:String;
		public var currPercent:Number = 100;
		public var drawSpeed:Number = 1;
		
		public var nameLabel:label;
		public var valueLabel:label;
		
		public var redrawTimer:int = 2;
		
		public function VerticalBar(p_main:Main,px:Number,py:Number,p_value:Number,p_name:String="",p_color:uint=0x00FF00) 
		{
			main = p_main;
			positionX = px;
			positionY = py;
			value = p_value;
			name = p_name;
			color = p_color;
		//	main.addEventListener(Event.ENTER_FRAME, update);
			nameLabel = new label(main, 0, 0, "");
			valueLabel = new label(main, 0, 0, "");
			display();
		}
		
		public function update(e:Event = null):void
		{
			if (currPercent <= 100)
			{
				if (redrawTimer < 0)
				{
					redrawTimer = 2;
					display();
				}
				currPercent += drawSpeed;
				redrawTimer--;
			}
		}
		
		public function display():void
		{
			calculateParameter();
			drawBar();
			displayText();
		}
		
		public function calculateParameter():void
		{
			scale = 1.8 / 200*120;
			height = value * scale*currPercent/100;
			p1.x = positionX - width / 2;
			p1.y = positionY;
			p2.x = positionX + width / 2;
			p2.y = positionY;
			p3.x = positionX + width / 2;
			p3.y = positionY - height;
			p4.x = positionX - width / 2;
			p4.y = positionY - height;
		}
		
		public function drawBar():void
		{
			main.graphics.beginFill(0x888888);
			if (height > 0)
			{
				main.graphics.drawRect(p4.x+3,p4.y-2+1,width,height-0.5);
			}
			else
			{
				main.graphics.drawRect(p1.x+3,p1.y+1+1,width,-height);
			}
			main.graphics.endFill();
			main.graphics.beginFill(color);
			if (height > 0)
			{
				main.graphics.drawRect(p4.x,p4.y-3,width,height);
			}
			else
			{
				main.graphics.drawRect(p1.x,p1.y+1,width,-height);
			}
			main.graphics.endFill();
			
		}
		
		public function displayText():void
		{
			if (height > 0)
			{
				nameLabel.changeText(positionX, positionY + 10,  9,name, 100);
				valueLabel.changeText( positionX, positionY - height-20, 15,value+"",  100);
			}
			else
			{
				nameLabel.changeText(positionX,positionY-15,9,name,100);
				valueLabel.changeText( positionX, positionY - height+15, 15,value+"",  100);
			}
		}
		
	}

}