package
{
	import flash.display.Sprite;
	import flash.events.Event;
	import flash.events.*;
	import flash.net.*;
	import flash.text.*;
	import flash.external.*;
	
	public class Main extends Sprite
	{
		private var MyFile:FileReference = new FileReference();
		private var strings:Array = new Array();
		private var bigString:String;
		private var prefix:String = "http://s3.amazonaws.com/tidepool_flash/frames/";
		
		public function Main():void
		{
			if (stage)
				init();
			else
				addEventListener(Event.ADDED_TO_STAGE, init);
		}
		
		private function init(e:Event = null):void
		{
			saveFile();
		}
		
		private function saveFile():void
		{
			//pushPenHolders();
			//pushIM();
			//pushViolin();
			//pushBalloons();
			//pushWLB();
			///pushClouds();
			//pushPathway();
			//pushFrames();
			pushFramesShort();
			//pushSpace();
			//pushDark();
			//pushBeach();
			trace(bigString);
			MyFile.save(bigString, "FileList.txt");
		}
		
		private function pushPenHolders():void
		{
			//PenHolders
			bigString = prefix + "PenHolders/assets/background.jpg";
			bigString += "@" + prefix + "PenHolders/assets/backplate.png";
			bigString += "@" + prefix + "PenHolders/assets/frontplate.png";
			for (var i:int = 1; i <= 4; i++)
			{
				bigString += "@" + prefix + "PenHolders/assets/frontplate" + i + ".png";
			}
			bigString += "@" + prefix + "PenHolders/assets/nextButton.png";
			bigString += "@" + prefix + "PenHolders/assets/nextButton-Over.png";
			bigString += "@" + prefix + "PenHolders/assets/pencil.png";
		}
		
		private function pushIM():void
		{
			//IM
			for (var i:int = 1; i <= 7; i++)
			{
				bigString += "@" + prefix + "IM" + i + "/assets/button.png";
				bigString += "@" + prefix + "IM" + i + "/assets/phoneBackground.png";
				bigString += "@" + prefix + "IM" + i + "/assets/replyMessage.png";
				bigString += "@" + prefix + "IM" + i + "/assets/sendMessageButton.png";
				bigString += "@" + prefix + "IM" + i + "/assets/techMessage.png";
			}
		}
		
		private function pushViolin():void
		{
			//Violin		
			for (var i:int = 1; i <= 8; i++)
			{		
				bigString += "@" + prefix + "Violin/assets/"+i+".jpg";
			}
			
			bigString += "@" + prefix + "Clouds/assets/background.jpg";
			bigString += "@" + prefix + "Violin/assets/backPlate.png";
			bigString += "@" + prefix + "Clouds/assets/Balloon_Blue.png";
			bigString += "@" + prefix + "Clouds/assets/Balloon_Green.png";
			bigString += "@" + prefix + "Clouds/assets/Balloon_Mask.png";			
			bigString += "@" + prefix + "Clouds/assets/Balloon_Orange.png";
			bigString += "@" + prefix + "Clouds/assets/Balloon_Pink.png";
			bigString += "@" + prefix + "Clouds/assets/Balloon_Purple.png";
			bigString += "@" + prefix + "Clouds/assets/Balloon_Red.png";
			bigString += "@" + prefix + "Clouds/assets/Balloon_String.png";
			bigString += "@" + prefix + "Clouds/assets/Balloon_Turqoise.png";
			bigString += "@" + prefix + "Clouds/assets/Balloon_Yellow.png";			
			bigString += "@" + prefix + "Violin/assets/bar.png";
			bigString += "@" + prefix + "Violin/assets/button.png";
			bigString += "@" + prefix + "Clouds/assets/frame.png";
			bigString += "@" + prefix + "Violin/assets/mask.png";
			bigString += "@" + prefix + "Violin/assets/nextButton.png";
			bigString += "@" + prefix + "Violin/assets/nextButtonOver.png";
			bigString += "@" + prefix + "Violin/assets/slider.png";
			bigString += "@" + prefix + "Violin/assets/sliderbar.png";
			bigString += "@" + prefix + "Violin/assets/sliderB-bar.png";
			bigString += "@" + prefix + "Violin/assets/sliderB-handle.png";
			bigString += "@" + prefix + "Violin/assets/sliderC-bar.png";
			bigString += "@" + prefix + "Violin/assets/sliderMask.png";
			bigString += "@" + prefix + "Violin/assets/Variety.jpg";
		}
		
		private function pushBalloons():void
		{
			//Balloons				
			for (var i:int = 1; i <= 9; i++)
			{
				bigString += "@" + prefix + "Balloon/assets/" + (i) + ".png";
			}
			bigString += "@" + prefix + "Balloon/assets/background.jpg";
			bigString += "@" + prefix + "Balloon/assets/Balloon_Blue.png";
			bigString += "@" + prefix + "Balloon/assets/Balloon_Green.png";
			bigString += "@" + prefix + "Balloon/assets/Balloon_LimeGreen.png";
			bigString += "@" + prefix + "Balloon/assets/Balloon_Orange.png";
			bigString += "@" + prefix + "Balloon/assets/Balloon_Pink.png";
			bigString += "@" + prefix + "Balloon/assets/Balloon_Purple.png";
			bigString += "@" + prefix + "Balloon/assets/Balloon_Red.png";
			bigString += "@" + prefix + "Balloon/assets/Balloon_String.png";
			bigString += "@" + prefix + "Balloon/assets/Balloon_Turqoise.png";
			bigString += "@" + prefix + "Balloon/assets/Balloon_Yellow.png";
			bigString += "@" + prefix + "Balloon/assets/frame.png";
			bigString += "@" + prefix + "Balloon/assets/Mask.png";
			bigString += "@" + prefix + "Balloon/assets/nextButton.png";
			bigString += "@" + prefix + "Balloon/assets/nextButtonOver.png";
		}
		
		private function pushWLB():void
		{
			//WLB			
			for (var i:int = 1; i <= 10; i++)
			{
				for (var j:int = 1; j <= 3; j++)
				{
					bigString += "@" + prefix + "WLB/assets/Briefcase/" + i + "/" + j + ".jpg";
				}
			}
			
			bigString += "@" + prefix + "WLB/assets/CheckList/check.png";
			bigString += "@" + prefix + "WLB/assets/CheckList/checkMask.png";
			bigString += "@" + prefix + "WLB/assets/CheckList/clipboard.png";
			bigString += "@" + prefix + "WLB/assets/CheckList/pen.png";
			
			bigString += "@" + prefix + "WLB/assets/Clock/clock.png";
			bigString += "@" + prefix + "WLB/assets/Clock/hand-1.png";
			bigString += "@" + prefix + "WLB/assets/Clock/mask.png";
			
			bigString += "@" + prefix + "WLB/assets/Couch/Couch.png";
			bigString += "@" + prefix + "WLB/assets/Couch/mask.png";
			
			bigString += "@" + prefix + "WLB/assets/Dream/1.jpg";
			bigString += "@" + prefix + "WLB/assets/Dream/2.jpg";
			bigString += "@" + prefix + "WLB/assets/Dream/3.jpg";
			bigString += "@" + prefix + "WLB/assets/Dream/mask.png";
			bigString += "@" + prefix + "WLB/assets/Dream/thoughtBubble.png";
			
			bigString += "@" + prefix + "WLB/assets/Family/Happy.png";
			bigString += "@" + prefix + "WLB/assets/Family/Sad.png";
			bigString += "@" + prefix + "WLB/assets/Family/mask.png";
			bigString += "@" + prefix + "WLB/assets/Family/No, they think I spend the right amount of time at work.png";
			bigString += "@" + prefix + "WLB/assets/Family/Sometimes.png";
			bigString += "@" + prefix + "WLB/assets/Family/Yes, they would like it if I spent more time at home.png";
			
			bigString += "@" + prefix + "WLB/assets/Map/Africa.png";
			bigString += "@" + prefix + "WLB/assets/Map/Alaska.png";
			bigString += "@" + prefix + "WLB/assets/Map/Australia.png";
			bigString += "@" + prefix + "WLB/assets/Map/black-thumbtack.png";
			bigString += "@" + prefix + "WLB/assets/Map/blue-thumbtack-(large).png";
			bigString += "@" + prefix + "WLB/assets/Map/blue-thumtack-(small).png";
			bigString += "@" + prefix + "WLB/assets/Map/Canada.png";
			bigString += "@" + prefix + "WLB/assets/Map/Central_America.png";
			bigString += "@" + prefix + "WLB/assets/Map/East_Asia.png";
			bigString += "@" + prefix + "WLB/assets/Map/East_Europe.png";
			bigString += "@" + prefix + "WLB/assets/Map/green-thumbtack.png";
			bigString += "@" + prefix + "WLB/assets/Map/Ice_Greenland.png";
			bigString += "@" + prefix + "WLB/assets/Map/Map.jpg";
			bigString += "@" + prefix + "WLB/assets/Map/mask.png";
			bigString += "@" + prefix + "WLB/assets/Map/Middle_East.png";
			bigString += "@" + prefix + "WLB/assets/Map/Pacific_Islands.png";
			bigString += "@" + prefix + "WLB/assets/Map/red-thumbtack.png";
			bigString += "@" + prefix + "WLB/assets/Map/Sout_Asia.png";
			bigString += "@" + prefix + "WLB/assets/Map/South_America.png";
			bigString += "@" + prefix + "WLB/assets/Map/US_North_East.png";
			bigString += "@" + prefix + "WLB/assets/Map/US_North_Midwest.png";
			bigString += "@" + prefix + "WLB/assets/Map/US_South_East.png";
			bigString += "@" + prefix + "WLB/assets/Map/US_South_Midwest.png";
			bigString += "@" + prefix + "WLB/assets/Map/US_South_West.png";
			bigString += "@" + prefix + "WLB/assets/Map/West_Asia.png";
			bigString += "@" + prefix + "WLB/assets/Map/West_Europe.png";
			bigString += "@" + prefix + "WLB/assets/Map/yellow-thumbtack.png";
			
			bigString += "@" + prefix + "WLB/assets/Nets/A+.png";
			bigString += "@" + prefix + "WLB/assets/Nets/BigHeart.png";
			bigString += "@" + prefix + "WLB/assets/Nets/black-net.jpg";
			bigString += "@" + prefix + "WLB/assets/Nets/blue-butterfly.png";
			bigString += "@" + prefix + "WLB/assets/Nets/blue-net.jpg";
			bigString += "@" + prefix + "WLB/assets/Nets/Girls.jpg";
			bigString += "@" + prefix + "WLB/assets/Nets/Graph.jpg";
			bigString += "@" + prefix + "WLB/assets/Nets/mask.png";
			bigString += "@" + prefix + "WLB/assets/Nets/orange-butterfly.png";
			bigString += "@" + prefix + "WLB/assets/Nets/PeopleComputer.jpg";
			bigString += "@" + prefix + "WLB/assets/Nets/purple-net.jpg";
			bigString += "@" + prefix + "WLB/assets/Nets/red-net.jpg";
			bigString += "@" + prefix + "WLB/assets/Nets/yellow-butterfly.png";
			
			bigString += "@" + prefix + "WLB/assets/Office/building-door.png";
			bigString += "@" + prefix + "WLB/assets/Office/buildingEdge.png";
			bigString += "@" + prefix + "WLB/assets/Office/DoorFrame.png";
			bigString += "@" + prefix + "WLB/assets/Office/WindowFrame.png";
			bigString += "@" + prefix + "WLB/assets/Office/WindowFrame-ReflectionB.png";
			for (var i:int = 1; i <= 7; i++)
			{
				for (var j:int = 1; j <= 3; j++)
				{
					bigString += "@" + prefix + "WLB/assets/Office/" + i + "/" + j + ".jpg";
					bigString += "@" + prefix + "WLB/assets/Office/" + i + "/" + j + ".png";
				}
			}
			
			bigString += "@" + prefix + "WLB/assets/Shiva/20 hours or fewer.png";
			bigString += "@" + prefix + "WLB/assets/Shiva/21-35 hours.png";
			bigString += "@" + prefix + "WLB/assets/Shiva/36-50 hours.png";
			bigString += "@" + prefix + "WLB/assets/Shiva/51-65 hours.png";
			bigString += "@" + prefix + "WLB/assets/Shiva/66+ hours.png";
			bigString += "@" + prefix + "WLB/assets/Shiva/mask.png";
			
			bigString += "@" + prefix + "WLB/assets/Trash/claustrophobic space.jpg";
			bigString += "@" + prefix + "WLB/assets/Trash/cubicle.jpg";
			bigString += "@" + prefix + "WLB/assets/Trash/home office.jpg";
			bigString += "@" + prefix + "WLB/assets/Trash/large office.jpg";
			bigString += "@" + prefix + "WLB/assets/Trash/other.jpg";
			bigString += "@" + prefix + "WLB/assets/Trash/small office.jpg";
			bigString += "@" + prefix + "WLB/assets/Trash/trashcan.png";
			
			bigString += "@" + prefix + "WLB/assets/Travel/airplane.png";
			bigString += "@" + prefix + "WLB/assets/Travel/boat.png";
			bigString += "@" + prefix + "WLB/assets/Travel/car.png";
			bigString += "@" + prefix + "WLB/assets/Travel/mask.png";
			bigString += "@" + prefix + "WLB/assets/Travel/train.png";
			
			bigString += "@" + prefix + "WLB/assets/WorkLife1/1.jpg";
			bigString += "@" + prefix + "WLB/assets/WorkLife1/2.jpg";
			bigString += "@" + prefix + "WLB/assets/WorkLife1/3.jpg";
			
			bigString += "@" + prefix + "WLB/assets/WorkLife2/1.jpg";
			bigString += "@" + prefix + "WLB/assets/WorkLife2/2.jpg";
			bigString += "@" + prefix + "WLB/assets/WorkLife2/3.jpg";
			
			bigString += "@" + prefix + "WLB/assets/addButton.png";
			bigString += "@" + prefix + "WLB/assets/addButton-over.png";
			bigString += "@" + prefix + "WLB/assets/bar.png";
			bigString += "@" + prefix + "WLB/assets/button.png";
			bigString += "@" + prefix + "WLB/assets/home.png";
			bigString += "@" + prefix + "WLB/assets/mask.png";
			bigString += "@" + prefix + "WLB/assets/modifyButton.png";
			bigString += "@" + prefix + "WLB/assets/modifyButton-over.png";
			bigString += "@" + prefix + "WLB/assets/nextButton.png";
			bigString += "@" + prefix + "WLB/assets/nextButton-Over.png";
			bigString += "@" + prefix + "WLB/assets/office.png";
			bigString += "@" + prefix + "WLB/assets/Radio_selected.png";
			bigString += "@" + prefix + "WLB/assets/Radio_unselected.png";
			bigString += "@" + prefix + "WLB/assets/slider.png";
			bigString += "@" + prefix + "WLB/assets/sliderbar.png";
			bigString += "@" + prefix + "WLB/assets/sliderB-bar.png";
			bigString += "@" + prefix + "WLB/assets/sliderB-handle.png";
			bigString += "@" + prefix + "WLB/assets/sliderC-bar.png";
			bigString += "@" + prefix + "WLB/assets/sliderMask.png";
		}
		
		private function pushClouds():void
		{
			//Clouds				
			for (var i:int = 1; i < 66; i++)
			{
				bigString += "@" + prefix + "Clouds/assets/Numbers/" + (i) + ".jpg";
			}
			bigString += "@" + prefix + "Clouds/assets/slower.png";
			bigString += "@" + prefix + "Clouds/assets/slowerOver.png";
			bigString += "@" + prefix + "Clouds/assets/faster.png";		
			bigString += "@" + prefix + "Clouds/assets/fasterOver.png";		
			bigString += "@" + prefix + "Clouds/assets/Artistic.png";		
			bigString += "@" + prefix + "Clouds/assets/background.jpg";		
			bigString += "@" + prefix + "Clouds/assets/Balloon_Blue.png";
			bigString += "@" + prefix + "Clouds/assets/Balloon_Green.png";
			bigString += "@" + prefix + "Clouds/assets/Balloon_Mask.png";			
			bigString += "@" + prefix + "Clouds/assets/Balloon_Pink.png";
			bigString += "@" + prefix + "Clouds/assets/Balloon_Red.png";
			bigString += "@" + prefix + "Clouds/assets/Balloon_White.png";
			bigString += "@" + prefix + "Clouds/assets/Balloon_Yellow.png";
			bigString += "@" + prefix + "Clouds/assets/black.jpg";
			bigString += "@" + prefix + "Clouds/assets/Clerical.png";
			bigString += "@" + prefix + "Clouds/assets/cloud.png";
			bigString += "@" + prefix + "Clouds/assets/frame.png";
			
			bigString += "@" + prefix + "Clouds/assets/Hands.png";
			bigString += "@" + prefix + "Clouds/assets/Managerial.png";
			bigString += "@" + prefix + "Clouds/assets/Math.png";
			bigString += "@" + prefix + "Clouds/assets/Mechanical.png";
			bigString += "@" + prefix + "Clouds/assets/Music.png";
			bigString += "@" + prefix + "Clouds/assets/nextButton.png";
			bigString += "@" + prefix + "Clouds/assets/nextButtonOver.png";
			bigString += "@" + prefix + "Clouds/assets/Office.png";
			bigString += "@" + prefix + "Clouds/assets/promptBox.png";
			bigString += "@" + prefix + "Clouds/assets/Sales.png";
			bigString += "@" + prefix + "Clouds/assets/Science.png";
				
			bigString += "@" + prefix + "Clouds/assets/String_Blue.png";
			bigString += "@" + prefix + "Clouds/assets/String_Green.png";		
			bigString += "@" + prefix + "Clouds/assets/String_Pink.png";
			bigString += "@" + prefix + "Clouds/assets/String_Red.png";
			bigString += "@" + prefix + "Clouds/assets/String_White.png";
			bigString += "@" + prefix + "Clouds/assets/String_Yellow.png";
			bigString += "@" + prefix + "Clouds/assets/sun.png";
			bigString += "@" + prefix + "Clouds/assets/Teaching.png";
			bigString += "@" + prefix + "Clouds/assets/Understanding_Others.png";
		}
		
		private function pushPathway():void
		{
			//Pathway			
			for (var i:int = 1; i <= 9; i++)
			{
				bigString += "@" + prefix + "Pathway/assets/" + (i) + ".png";
			}
			bigString += "@" + prefix + "Pathway/assets/bg.jpg";
			bigString += "@" + prefix + "Pathway/assets/blackMask.png";
			bigString += "@" + prefix + "Pathway/assets/circleMask.png";
			bigString += "@" + prefix + "Pathway/assets/nextButton.png";
			bigString += "@" + prefix + "Pathway/assets/nextButton-Over.png";
			bigString += "@" + prefix + "Pathway/assets/step.png";
			bigString += "@" + prefix + "Pathway/assets/stepHolder.png";
			bigString += "@" + prefix + "Pathway/assets/stepHolderGlow.png";
		}
		
		private function pushFramesShort():void
		{
			//Frames
			for (var i:int = 1; i <= 2; i++)
			{
				bigString += "@" + prefix + "Frames/assets/F" + (i) + "a.jpg";
				bigString += "@" + prefix + "Frames/assets/F" + (i) + "b.jpg";
				bigString += "@" + prefix + "Frames/assets/F" + (i) + "c.jpg";
				bigString += "@" + prefix + "Frames/assets/F" + (i) + "d.jpg";
				bigString += "@" + prefix + "Frames/assets/F" + (i) + "e.jpg";
			}
			
			bigString += "@" + prefix + "Frames/assets/background.jpg";
			bigString += "@" + prefix + "Frames/assets/frames.png";
			bigString += "@" + prefix + "Frames/assets/frames2.png";
			bigString += "@" + prefix + "Frames/assets/promptBox.png";
			bigString += "@" + prefix + "Frames/assets/sliver.png";
			bigString += "@" + prefix + "Frames/assets/timerBackplate.png";
			bigString += "@" + prefix + "Frames/assets/timerBar.png";
			bigString += "@" + prefix + "Frames/assets/trashCan.png";
		}
		
		private function pushFrames():void
		{
			//Frames
			for (var i:int = 1; i <= 7; i++)
			{
				bigString += "@" + prefix + "Frames/assets/F" + (i) + "a.jpg";
				bigString += "@" + prefix + "Frames/assets/F" + (i) + "b.jpg";
				bigString += "@" + prefix + "Frames/assets/F" + (i) + "c.jpg";
				bigString += "@" + prefix + "Frames/assets/F" + (i) + "d.jpg";
				bigString += "@" + prefix + "Frames/assets/F" + (i) + "e.jpg";
			}
			for (i = 1; i <= 14; i++)
			{
				bigString += "@" + prefix + "Frames/assets/P" + (i) + "a.jpg";
				bigString += "@" + prefix + "Frames/assets/P" + (i) + "b.jpg";
			}
			bigString += "@" + prefix + "Frames/assets/background.jpg";
			bigString += "@" + prefix + "Frames/assets/frames.png";
			bigString += "@" + prefix + "Frames/assets/frames2.png";
			bigString += "@" + prefix + "Frames/assets/promptBox.png";
			bigString += "@" + prefix + "Frames/assets/sliver.png";
			bigString += "@" + prefix + "Frames/assets/timerBackplate.png";
			bigString += "@" + prefix + "Frames/assets/timerBar.png";
			bigString += "@" + prefix + "Frames/assets/trashCan.png";
		}
		
		private function pushSpace():void
		{
			//Space
			for (var i:int = 1; i <= 24; i++)
			{
				bigString += "@" + prefix + "Space/assets/a" + (i) + ".jpg";
				bigString += "@" + prefix + "Space/assets/b" + (i) + ".jpg";
			}
			bigString += "@" + prefix + "Space/assets/background.jpg";
			bigString += "@" + prefix + "Space/assets/mask.png";
			bigString += "@" + prefix + "Space/assets/sliver.png";
			bigString += "@" + prefix + "Space/assets/submitButton.png";
			bigString += "@" + prefix + "Space/assets/submitButtonOver.png";
			bigString += "@" + prefix + "Space/assets/timerBackplate.png";
			bigString += "@" + prefix + "Space/assets/timerBar.png";
		}
		
		private function pushDark():void
		{
			//Dark
			for (var i:int = 1; i <= 6; i++)
			{
				bigString += "@" + prefix + "Dark/assets/castle" + (i) + ".jpg";
				bigString += "@" + prefix + "Dark/assets/face" + (i) + ".jpg";
				bigString += "@" + prefix + "Dark/assets/flower" + (i) + ".jpg";
				bigString += "@" + prefix + "Dark/assets/moon" + (i) + ".jpg";
				bigString += "@" + prefix + "Dark/assets/sun" + (i) + ".jpg";
			}
			bigString += "@" + prefix + "Dark/assets/slider.png";
			bigString += "@" + prefix + "Dark/assets/sliderbar.png";
			bigString += "@" + prefix + "Dark/assets/sliderB-bar.png";
			bigString += "@" + prefix + "Dark/assets/sliderB-handle.png";
			bigString += "@" + prefix + "Dark/assets/sliderC-bar.png";
			bigString += "@" + prefix + "Dark/assets/sliderMask.png";
			bigString += "@" + prefix + "Dark/assets/submitButton-Over.png";
			bigString += "@" + prefix + "Dark/assets/submitButton.png";
		}
		
		private function pushBeach():void
		{
			//Beach
			for (var i:int = 1; i <= 8; i++)
			{
				bigString += "@" + prefix + "Beach/assets/Picnic/food" + i + ".png";
			}
			bigString += "@" + prefix + "Beach/assets/Picnic/hand.png";
			bigString += "@" + prefix + "Beach/assets/Picnic/hand2.png";
			bigString += "@" + prefix + "Beach/assets/Picnic/hand3.png";
			bigString += "@" + prefix + "Beach/assets/Picnic/plate-mouse.png";
			
			bigString += "@" + prefix + "Beach/assets/Places/1.jpg";
			bigString += "@" + prefix + "Beach/assets/Places/2.jpg";
			bigString += "@" + prefix + "Beach/assets/Places/lifeguard.jpg";
			bigString += "@" + prefix + "Beach/assets/Places/path1.jpg";
			bigString += "@" + prefix + "Beach/assets/Places/path2.jpg";
			bigString += "@" + prefix + "Beach/assets/Places/pier.jpg";
			
			bigString += "@" + prefix + "Beach/assets/SeaShells/Bucket-1-rock.png";
			bigString += "@" + prefix + "Beach/assets/SeaShells/Bucket-1-shell&rock.png";
			bigString += "@" + prefix + "Beach/assets/SeaShells/Bucket-1-shell.png";
			bigString += "@" + prefix + "Beach/assets/SeaShells/Bucket-2shell&2rock.png";
			bigString += "@" + prefix + "Beach/assets/SeaShells/Bucket-2shell&3rock.png";
			bigString += "@" + prefix + "Beach/assets/SeaShells/Bucket-4shell&4rock.png";
			bigString += "@" + prefix + "Beach/assets/SeaShells/Bucket-5shell&5rock.png";
			bigString += "@" + prefix + "Beach/assets/SeaShells/Bucket-6shell&5rock.png";
			bigString += "@" + prefix + "Beach/assets/SeaShells/Bucket-6shell&6rock.png";
			bigString += "@" + prefix + "Beach/assets/SeaShells/Bucket-6shell&7rock.png";
			bigString += "@" + prefix + "Beach/assets/SeaShells/Bucket-7shell&7rock.png";
			bigString += "@" + prefix + "Beach/assets/SeaShells/Bucket-empty.png";
			bigString += "@" + prefix + "Beach/assets/SeaShells/1/False.png";
			bigString += "@" + prefix + "Beach/assets/SeaShells/1/True.png";
			bigString += "@" + prefix + "Beach/assets/SeaShells/2/False.png";
			bigString += "@" + prefix + "Beach/assets/SeaShells/2/True.png";
			bigString += "@" + prefix + "Beach/assets/SeaShells/3/1.png";
			bigString += "@" + prefix + "Beach/assets/SeaShells/3/2.png";
			bigString += "@" + prefix + "Beach/assets/SeaShells/3/3.png";
			bigString += "@" + prefix + "Beach/assets/SeaShells/4/1.png";
			bigString += "@" + prefix + "Beach/assets/SeaShells/4/2.png";
			bigString += "@" + prefix + "Beach/assets/SeaShells/4/3.png";
			bigString += "@" + prefix + "Beach/assets/SeaShells/4/4.png";
			bigString += "@" + prefix + "Beach/assets/SeaShells/5/Not really supportive.png";
			bigString += "@" + prefix + "Beach/assets/SeaShells/5/Not supportive at all.png";
			bigString += "@" + prefix + "Beach/assets/SeaShells/5/Somewhat supportive.png";
			bigString += "@" + prefix + "Beach/assets/SeaShells/5/Very supportive.png";
			bigString += "@" + prefix + "Beach/assets/SeaShells/6/0.png";
			bigString += "@" + prefix + "Beach/assets/SeaShells/6/1-2.png";
			bigString += "@" + prefix + "Beach/assets/SeaShells/6/3-4.png";
			bigString += "@" + prefix + "Beach/assets/SeaShells/6/5-6.png";
			bigString += "@" + prefix + "Beach/assets/SeaShells/6/7+.png";
			
			bigString += "@" + prefix + "Beach/assets/Surf/s2.png";
			bigString += "@" + prefix + "Beach/assets/Surf/s16.png";
			bigString += "@" + prefix + "Beach/assets/Surf/wave1.jpg";
			bigString += "@" + prefix + "Beach/assets/Surf/wave2.jpg";
			bigString += "@" + prefix + "Beach/assets/Surf/wave3.jpg";
			bigString += "@" + prefix + "Beach/assets/Surf/wave4.jpg";
			bigString += "@" + prefix + "Beach/assets/Surf/wave5.jpg";
			bigString += "@" + prefix + "Beach/assets/Surf/wave6.jpg";
			
			bigString += "@" + prefix + "Beach/assets/TugOfWar/Slider/bar.png";
			bigString += "@" + prefix + "Beach/assets/TugOfWar/Slider/mask.png";
			bigString += "@" + prefix + "Beach/assets/TugOfWar/Hand1-small.png";
			bigString += "@" + prefix + "Beach/assets/TugOfWar/I can stay focused/Most of the time.jpg";
			bigString += "@" + prefix + "Beach/assets/TugOfWar/I can stay focused/Not really.jpg";
			bigString += "@" + prefix + "Beach/assets/TugOfWar/I can stay focused/Sometimes.jpg";
			bigString += "@" + prefix + "Beach/assets/TugOfWar/I finish what I start/Most of the time.jpg";
			bigString += "@" + prefix + "Beach/assets/TugOfWar/I finish what I start/Not really.jpg";
			bigString += "@" + prefix + "Beach/assets/TugOfWar/I finish what I start/Sometimes.jpg";
			bigString += "@" + prefix + "Beach/assets/TugOfWar/I will not be deterred from reaching my goal/I do not have this attitude.jpg";
			bigString += "@" + prefix + "Beach/assets/TugOfWar/I will not be deterred from reaching my goal/I have this attitude.jpg";
			bigString += "@" + prefix + "Beach/assets/TugOfWar/I will not be deterred from reaching my goal/I sometimes have this attitude.jpg";
			
			bigString += "@" + prefix + "Beach/assets/bar.png";
			bigString += "@" + prefix + "Beach/assets/bottle.png";
			bigString += "@" + prefix + "Beach/assets/False-off.png";
			bigString += "@" + prefix + "Beach/assets/False-over.png";
			bigString += "@" + prefix + "Beach/assets/mask.png";
			bigString += "@" + prefix + "Beach/assets/nextButton.png";
			bigString += "@" + prefix + "Beach/assets/nextButton-Over.png";
			bigString += "@" + prefix + "Beach/assets/ocean.jpg";
			bigString += "@" + prefix + "Beach/assets/slider.png";
			bigString += "@" + prefix + "Beach/assets/sliderB-bar.png";
			bigString += "@" + prefix + "Beach/assets/sliderB-handle.png";
			bigString += "@" + prefix + "Beach/assets/sliderC-bar.png";
			bigString += "@" + prefix + "Beach/assets/sliderMask.png";
			bigString += "@" + prefix + "Beach/assets/True-off.png";
			bigString += "@" + prefix + "Beach/assets/True-over.png";
		}
	}
}
