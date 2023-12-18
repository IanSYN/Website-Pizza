package view;
import javax.swing.*;


import java.awt.*;
import java.io.FileNotFoundException;
import javax.swing.border.EmptyBorder;

import inter.Colors;
//import app.NavBar;

@SuppressWarnings("serial")
public class VCuisine extends JFrame implements Colors {
	
		//jPanel instanciation
	    JPanel mainGridPan = new JPanel(); //the main panel that contains two sub-panels
	    JPanel subGridUserPan = new JPanel(); //the sub-panel that contains the left and right panels
	    JPanel hautPan = new JPanel(); //the sub-panel that contains the navigation bar
	    JPanel gauchePan = new JPanel(); //the left panel that contains the user's image and basic information
	    JPanel droitePan = new JPanel(); //the right panel that contains the user's full bio
	    
	    //GridLayout mainGrid = new GridLayout(2,1);
	    GridLayout subGridUser = new GridLayout(1,2); //the layout for the sub-panel that divides it into two columns
	    
	    //label
	    JLabel txtPseudo = new JLabel(user.getPseudo()); //a label that displays the user's pseudo
	    JLabel txtMiniBio = new JLabel(user.getMiniBio()); //a label that displays the user's mini bio
		JLabel txtTitreBio = new JLabel(user.getPseudo()+"'s full bio :"); //a label that displays the title of the full bio section
		JLabel txtDroite = new JLabel (user.getBio()); //a label that displays the user's full bio
	    
	    //frame settings
	    setBackground(Color.gray); //set the frame's background color to gray
	    setSize(1080,720); //set the frame's size to 1080 by 720 pixels
	    setVisible(true); //make the frame visible
	    setResizable(false); //make the frame not resizable
	    setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE); //make the frame close when clicking on X button
	    
	    //pan set layout and add
	    mainGridPan.setLayout(new BoxLayout(mainGridPan, BoxLayout.PAGE_AXIS)); //set the main panel's layout to a vertical box layout
	    subGridUserPan.setLayout(subGridUser); //set the sub-panel's layout to a grid layout with one row and two columns
	    gauchePan.setLayout(new BoxLayout(gauchePan, BoxLayout.PAGE_AXIS)); //set the left panel's layout to a vertical box layout
	    droitePan.setLayout(new BoxLayout(droitePan, BoxLayout.PAGE_AXIS)); //set the right panel's layout to a vertical box layout
	    
	    //grid set size
	    navPan.setMaximumSize(new Dimension(navPan.getMaximumSize().width, 5000)); //set the navigation panel's maximum width to a large value
	    gauchePan.setMaximumSize(new Dimension(gauchePan.getMaximumSize().height, 10000)); //set the left panel's maximum height to a large value
	    droitePan.setMaximumSize(new Dimension(droitePan.getMaximumSize().height, 40000)); //set the right panel's maximum height to a large value
	    
	    //img pour l'icone de l'user
	    String imgUrl=user.getPfp(); //get the image url from the user object
	    ImageIcon pfp = new ImageIcon(imgUrl); //create an image icon from the url
		Image image = pfp.getImage(); //get the image from the icon
		Image newimg = image.getScaledInstance(120, 120,  java.awt.Image.SCALE_SMOOTH); //scale the image to fit in a 120 by 120 pixels area
		pfp = new ImageIcon(newimg);  //create a new icon from the scaled image
		JLabel imgPfp = new JLabel(pfp); //create a label that displays the icon
		
		/*Here is where I found how to resize an ImageIcon:
		http://www.nullpointer.at/2011/08/21/java-code-snippets-howto-resize-an-imageicon/#comment-11870*/
		
		//le btn, sa couleur 
		JButton btnEditU = new JButton("Edit Profile");
		BtnEditUser btnEdit = new BtnEditUser(user, this);
		btnEditU.addActionListener(btnEdit);
		btnEditU.setBackground(PURPLE);

		//font size
		txtPseudo.setFont(new Font("SansSerif", Font.PLAIN, 30)); //set the pseudo label's font size to 30 points 
		txtMiniBio.setFont(new Font("SansSerif", Font.PLAIN, 15)); //set the mini bio label's font size to 15 points 
		txtTitreBio.setFont(new Font("SansSerif", Font.PLAIN, 20)); //set the full bio title label's font size to 20 points 
		txtDroite.setFont(new Font("SansSerif", Font.PLAIN, 15)); //set the full bio label's font size t 15 points 
	    
		//grid and pan add
	    add(mainGridPan); //add the main panel to the frame
	    mainGridPan.add(navPan); //add the navigation panel to the main panel
	    mainGridPan.add(subGridUserPan); //add the sub-panel to the main panel
	    subGridUserPan.add(gauchePan); //add the left panel to the sub-panel
	    subGridUserPan.add(droitePan); //add the right panel to the sub-panel
	    gauchePan.add(imgPfp); //add the icon label to the left panel
	    gauchePan.add(txtPseudo); //add the pseudo label under the pfp
	    gauchePan.add(txtMiniBio); //add the mini bio label under the pseudo
		gauchePan.add(btnEditU); //add the edit btn under the mini bio
	    droitePan.add(txtTitreBio); //add the full bio title label to the right panel
	    droitePan.add(txtDroite); //add the full bio on the right under its title
	    
	    //mettre les components au centre
	    imgPfp.setAlignmentX(CENTER_ALIGNMENT); //align the icon label 
	    txtPseudo.setAlignmentX(CENTER_ALIGNMENT); //align the pseudo label 
	    txtMiniBio.setAlignmentX(CENTER_ALIGNMENT); //align the mini bio label 
		btnEditU.setAlignmentX(CENTER_ALIGNMENT);
	    txtTitreBio.setAlignmentX(CENTER_ALIGNMENT); //align the full bio title label
	    txtDroite.setAlignmentX(CENTER_ALIGNMENT); //align the full bio label 

	    //padding (top,left,bottom,right) 
	    imgPfp.setBorder(new EmptyBorder(50,0,20,0)); //add some padding around the icon label //
	    txtPseudo.setBorder(new EmptyBorder(0,0,20,0)); //add some padding below the pseudo label //
	    txtMiniBio.setBorder(new EmptyBorder(5,20,20,20)); //add some padding around the mini bio label //
	    txtTitreBio.setBorder(new EmptyBorder(50,20,20,20)); //add some padding around the full bio title label //
	    txtDroite.setBorder(new EmptyBorder(20,20,50,20)); //add some padding around the full bio label //
		btnEditU.setBorder(new EmptyBorder(5,5,15,5)); //add some padding around the full bio label //

	    //coloring/ 
	    mainGridPan.setBorder(BorderFactory.createLineBorder(Color.black)); //set the main panel's border color to black //
	    subGridUserPan.setBorder(BorderFactory.createLineBorder(Color.black)); //set the sub-panel's border color to black //
	    navPan.setBorder(BorderFactory.createLineBorder(Color.black)); //set the navigation panel's border color to black //
	    gauchePan.setBorder(BorderFactory.createLineBorder(Color.black)); //set the left panel's border color to black //
	    droitePan.setBorder(BorderFactory.createLineBorder(Color.black)); //set the right panel's border color to black //

	    mainGridPan.setBackground(BLUEBG);   //set the main panel's background color to blue //
	    navPan.setBackground(GREENNAV);   //set the navigation panel's background color to green //
	    gauchePan.setBackground(BLUEBG);   //set the left panel's background color to blue //
	    droitePan.setBackground(BLUEBG);   //set the right panel's background color to blue //

}
}
