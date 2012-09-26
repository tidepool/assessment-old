package  
{
	import flash.events.Event;
	import flash.events.KeyboardEvent;
	import flash.events.MouseEvent;
	import flash.ui.Keyboard;
	import flash.utils.getTimer;
	
	public class Picture6Select
	{
		public var main:Main;
		public var text1:Label;
		public var pictures:Array;
		public var s:String;
		
		public function Picture6Select(p_main:Main,p_s:String="moon") 
		{
			main = p_main;
			text1 = new Label(main, 0, 0, "");
			pictures = new Array();
			s = p_s;
			main.textHint.sprite.alpha = 0;
			main.shouldFadeIn = false;
			
			text1.changeText(300, 5, 45, "Select the closest match to your visualization");
			text1.changeWidth(1000);
			pictures.push(new PictureButton(main, 400, 250, 300, "assets/"+s+"1.jpg"));
			pictures.push(new PictureButton(main, 800, 250, 300, "assets/"+s+"2.jpg"));
			pictures.push(new PictureButton(main, 1200, 250, 300, "assets/"+s+"3.jpg"));
			pictures.push(new PictureButton(main, 400, 600, 300, "assets/"+s+"4.jpg"));
			pictures.push(new PictureButton(main, 800, 600, 300, "assets/"+s+"5.jpg"));
			pictures.push(new PictureButton(main, 1200, 600, 300, "assets/"+s+"6.jpg"));
			for (var i:int = 0; i < pictures.length; i++ )
			{
				pictures[i].myLoader.addEventListener(MouseEvent.CLICK, onMouseClick);
			}			
			main.taskTime = getTimer();
		}
		
		public function onMouseClick(e:MouseEvent):void
		{
			for (var i:int = 0; i < pictures.length; i++ )
			{
				if (pictures[i].myLoader == e.target)
				{
					break;
				}
			}
			var length:int = pictures[i].string.length;
			var name:String = pictures[i].string.substring(18, length - 5);			
			var num:String = pictures[i].string.substring(length - 5, length - 4);
			main.xmlString += "<"+s+">";
			main.xmlString += num;
			main.xmlString += "</"+s+">";
			main.strings.push(pictures[i].string);
			for ( i = 0; i < pictures.length; i++ )
			{
				pictures[i].remove();
			}
			text1.remove();
			main.timeDiff = getTimer() - main.taskTime;
			main.changeString += "<select>" + main.timeDiff + "</select>";
			//trace(main.changeString);
			main.displayNext();
		}
		
	}

}