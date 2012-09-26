package  
{
	import flash.events.Event;
	import flash.events.MouseEvent;
	/**
	 * ...
	 * @author Wei
	 */
	public class ListItem 
	{
		public var main:Object;
		public var list:List;
		
		public var positionX:Number;
		public var positionY:Number;
		
		public var name:String;
		public var picURL:String;
		public var workType:String;
		
		public var pic:Picture;
		public var nameLabel:Label;
		public var companyLabel:Label;
		public var compare:Label;
		
		
		public var isOver:Boolean = false;
		public var isSelected:Boolean = false;
		public var lastOver:Boolean = true;
		public var lastSelected:Boolean = false;
		public var alpha:Number = 0;
		
		
		public var cloud:String;
		public var frames:Array;
		public var space:Number;
		
		public var offset:Number = 0;
		
		public var compareString:String="";
		public var desString:String;
		
		public var company:String;
		public var shown:Boolean = false;
		private var visible:Boolean = false;
		
		public var testPic:Picture;
		
		public function ListItem(p_main:Object,p_list:List,px:Number,py:Number,p_name:String,p_url:String,p_company:String,p_worktype:String,p_des:String="",p_cloud:String="interest",p_frames:Array=null,p_space:Number=1) 
		{
			main = p_main;
			list = p_list;
			positionX = px;
			positionY = py;
			name = p_name;
			picURL = p_url;
			desString = p_des;
			workType = p_worktype;
			cloud = p_cloud;
			frames = p_frames;
			space = p_space;
			company = p_company;
		}
		
		public function show():void
		{
			doCompare();
			pic = new Picture(main, positionX, positionY, picURL, 80);
			nameLabel = new Label(main, positionX + 50, positionY - 20, name+" | "+"TidePool" , 20, 800, false);
			//companyLabel = new Label(main, positionX + 100, positionY - 20,  company, 20, 800, false);
			compare = new Label(main, positionX + 50, positionY + 20, desString,20,800,false);
			main.stage.addEventListener(MouseEvent.MOUSE_MOVE, move);
			main.stage.addEventListener(MouseEvent.CLICK, click);
			main.stage.addEventListener(Event.ENTER_FRAME, update);
			shown = true;
			visible = true;
			main.graphics.lineStyle();
			main.graphics.beginFill(0xffffff, 1);
			main.graphics.drawRect(positionX - list.height/2, positionY - list.height/2+offset, list.width, list.height);
			main.graphics.endFill();
		}
		public function hide():void
		{
			doCompare();
			pic = new Picture(main, positionX, positionY, picURL, 80);
			nameLabel = new Label(main, positionX + 50, positionY - 20, name+" | "+"TidePool" , 20, 800, false);
			companyLabel = new Label(main, positionX + 100, positionY - 20,  company, 20, 800, false);
			compare = new Label(main, positionX + 50, positionY + 20, desString,20,800,false);
			main.stage.addEventListener(MouseEvent.MOUSE_MOVE, move);
			main.stage.addEventListener(MouseEvent.CLICK, click);
			main.stage.addEventListener(Event.ENTER_FRAME, update);
		}
		
		public function doCompare():void
		{
			/*
			if (workType == main.currentUser.workType)
			{
				if ((cloud - main.currentUser.cloud) * (cloud - main.currentUser.cloud) + (frames - main.currentUser.frames) * (frames - main.currentUser.frames) + (space-main.currentUser.space) * (space-main.currentUser.space) < 100)
				{
					compareString = "You two are similar in both work type and personality.";
				}
				else
				{
					compareString = "You have the same work type.";
				}
			}
			else
			{
				if ((cloud - main.currentUser.cloud) * (cloud - main.currentUser.cloud) + (frames - main.currentUser.frames) * (frames - main.currentUser.frames) + (space-main.currentUser.space) * (space-main.currentUser.space) < 100)
				{
					compareString = "You have the similar personality";
				}
				else
				{
					compareString = "You have nothing similar";
				}
			}
			*/
		}
		
		public function applyOffset(o:Number):void
		{
			pic.setPosition(positionX, positionY + o);
			nameLabel.setPosition(positionX + 50, positionY - 20 + o);
			//companyLabel.setPosition(positionX + 100, positionY - 20 + o);
			compare.setPosition(positionX + 50, positionY + 20 + o);
			offset = o;
			update();
		}
		
		public function update(e:Event=null):void
		{
			
		//	list.main.hideCompany();
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
				//	margin = 0;
				}
				
			//	applyOffset( -list.bar.value / (list.bar.length - 57) * margin);
			//	applyOffset( -list.bar.value);
				
				
				var nameColor:uint;
				
				main.graphics.lineStyle();
				main.graphics.beginFill(0xffffff, 1);
				main.graphics.drawRect(positionX - list.height/2, positionY - list.height/2 + offset, list.width, list.height);
				main.graphics.endFill();
					
				nameLabel.text.textColor = 0;
				
				
				if (isOver)
				{
					main.graphics.beginFill(0x99ff99, 0.4);
					main.graphics.drawRect(positionX - list.height/2, positionY - list.height/2 + offset, list.width, list.height);
					main.graphics.endFill();
					nameLabel.text.textColor = 0x3388FF;
					
				}
				if (isSelected)
				{
					main.graphics.beginFill(0x999999, 0.3);
					main.graphics.drawRect(positionX - list.height/2, positionY - list.height/2 + offset, list.width, list.height);
					main.graphics.endFill();
					nameLabel.text.textColor = 0x1144FF;
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
				
				list.main.hideCompany();
				list.selectedURL = picURL;
				list.main.compare.showPage();
				list.main.compare.setData(picURL,workType.substr(0,2));
				
				for (var i:int = 0; i < list.itemsList.length; i++ )
				{
					list.itemsList[i].isSelected = false;
				}
				isSelected = true;
			//	main.graphics.clear();
				list.main.graph.addLines();
			//	trace(frames[1]);
				list.main.graph.updateStats(frames, name);
			
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