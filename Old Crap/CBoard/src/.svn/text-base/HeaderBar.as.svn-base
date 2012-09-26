package  
{
	import adobe.utils.CustomActions;
	import flash.display.Sprite;
	import flash.events.Event;
	import flash.geom.Point;
	import flash.events.MouseEvent;
	import flash.text.*;
	
	public class HeaderBar 
	{
		private var main:Main;
		private var settings:Label;
		private var logout:Label;
		private var search:Label;		
		private var searchBar:Picture;			
		private var sprite:Sprite;
		private var searchText:TextField;
		
		public function HeaderBar(p_main:Main)
		{
			main = p_main;
			sprite = new Sprite();
			sprite.graphics.beginFill(0xC0504D);
			sprite.graphics.drawRect(0, 0, 1600, 50);
			main.addChild(sprite);
			
			settings = new Label(main, 1200, 25, "Settings", 16, 100, true, 0xFFFFFF);
			logout = new Label(main, 1275, 25, "Logout", 16, 100, true, 0xFFFFFF);
			search = new Label(main, 1350, 25, "Search", 16, 100, true, 0xFFFFFF);
			searchBar = new Picture(main, 1500, 27, "assets/searchBar.png", 160, true);
			
			searchText = new TextField();
			searchText.width = 150;			
			searchText.multiline = true;
			searchText.wordWrap = true;
			searchText.text = "";
			searchText.type = TextFieldType.INPUT;
			searchText.maxChars = 23;
			searchText.selectable = true;
			searchText.x = 1425;
			searchText.y = 18;
			searchText.textColor = 0;
            searchText.antiAliasType=AntiAliasType.ADVANCED;
            searchText.autoSize=TextFieldAutoSize.LEFT;
			searchText.gridFitType = GridFitType.SUBPIXEL;			
			var format:TextFormat = new TextFormat();
			format.font="helvetica";
			format.size = 11;
            searchText.setTextFormat(format);
			main.addChild(searchText);
		}		
		
		public function update():void
		{
			main.setChildIndex(searchText, main.numChildren - 1);
		}
	}

}