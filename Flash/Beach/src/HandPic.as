package  
{
	import flash.events.Event;
	import flash.events.MouseEvent;
	
	public class HandPic extends pictureWithMask 
	{
		public var screen:Picnic;
		public var discriptionText:String;
		public var discription:Label;
		public var isSelected:Boolean = false;
		public function HandPic(p_main:Main, p_x:Number, p_y:Number, s:String, p_length:Number,p_screen:Picnic,p_discriptionText:String ,p_defaultIndex:int=10) 
		{
			super(p_main, p_x, p_y, s, p_length, p_defaultIndex);
			discriptionText = p_discriptionText;
			screen = p_screen;
			discription = new Label(main,0,0,"");
			discription.changeText(positionX, positionY + 100, 25, discriptionText, 400, true);
		}

		
		public override function click(e:MouseEvent=null):void
		{
			new picture(main, positionX, positionY, screen.foodURL, 200);
			screen.hideplate();
			screen.selected();
			screen.noPic.masksprite.removeEventListener(MouseEvent.CLICK, screen.noPic.click);
			screen.sometimesPic.masksprite.removeEventListener(MouseEvent.CLICK, screen.sometimesPic.click);
			screen.yesPic.masksprite.removeEventListener(MouseEvent.CLICK, screen.yesPic.click);
			
			isSelected = true;
		}
		
		public override function move(e:MouseEvent = null):void
		{
			discription.text.textColor = 0x8746FF;
		}
		
		public override function out(e:MouseEvent = null):void
		{
			discription.text.textColor = 0;
		}
	}

}