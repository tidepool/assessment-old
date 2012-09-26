package  
{
	import flash.display.Sprite;
	import flash.events.Event;
	import flash.events.KeyboardEvent;
	import flash.events.MouseEvent;
	import flash.ui.Keyboard;
	import flash.utils.getTimer;
	
	public class FeedBackScreen 
	{
		public var main:Main;
		public var startTime:Number;
		public var text:Label;
		public var texts:Array;
		public var index:int;
		public var pic:PictureButton;
		public var s1:String;
		public var s2:String;
		public var s3:String;
		public function FeedBackScreen(p_main:Main,p_index:int,p_s1:String,p_s2:String,p_s3:String) 
		{
			main = p_main;
			index = p_index;
			s1 = p_s1;
			s2 = p_s2;
			s3 = p_s3;
			texts = new Array();
		}
		
		public function render():void
		{
			//main.graphics.beginFill(0, 1);
			//main.graphics.drawCircle(500, 500, 2000);
			//main.graphics.endFill();
			text = new Label(main, 400, 50, "Whoops, change of plans. We need your help. Based on your selected photo, which feedback were we going to give you?", 45, false);
			pic = new PictureButton(main, 800, 460, 300, main.strings[index]);
			texts.push(new Label(main, 0, 700, s1, 40,false,this));
			texts[0].changeWidth(600);
			texts.push(new Label(main, 500, 700, s2,40,false,this));
			texts[1].changeWidth(600);
			texts.push(new Label(main, 1000, 700, s3,40,false,this));
			texts[2].changeWidth(600);
			for (var i:int = 0; i < texts.length; i++ )
			{
				texts[i].sprite.addEventListener(MouseEvent.CLICK, click);				
				texts[i].sprite.addEventListener(MouseEvent.MOUSE_OVER, over);
				texts[i].sprite.addEventListener(MouseEvent.MOUSE_OUT, out);
			}
			main.taskTime = getTimer();			
		}
		
		public function update():void
		{

		}
		
		public function keyPress():void
		{
			
		}
		public function over(e:MouseEvent):void
		{
			e.target.textColor = 0x0000FF;
		}
		
		public function out(e:MouseEvent):void
		{			
			e.target.textColor = 0xFFFFFF;
		}
		
		
		
		public function writeXML():void
		{
		
		}
		
		public function click(e:MouseEvent):void
		{
			var length:int = main.strings[index].length;
			var name:String = main.strings[index].substring(7, length - 5);	
			trace("this is the string: "+main.strings[index]);
			main.xmlString += "<"+name+">";
			main.xmlString += e.target.text;
			main.xmlString += "</" + name + ">";
			main.timeDiff = getTimer() - main.taskTime;
			main.changeString += "<feedback>" + main.timeDiff + "</feedback>";
			main.stringsSelected.push(e.target.text);
			pic.remove();
			text.remove();
			for (var i:int = 0; i < texts.length; i++ )
			{
				texts[i].remove();
			}
			main.displayNext();
		}
		
		
	}

}