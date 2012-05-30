<h1>User Profile</h1>
<p>You can view and update your profile information.</p>


<hr> 
<form action="<?=$formAction?>" method='post'>
    <label>Acronym: <br/>
    <input type="text" name="acronym" value="<?=$user['acronym']?>" readonly="true" /></label>
    
    <label><br/>Password: <br/>
    <input type="password" name="password" /></label>
    
    <label><br/>Password again: <br/>
    <input type="password" name="password1" /></label>
    <br/>
    <input type='submit' name='doChangePassword' value='Change Password' />
    
    <label><br/>Name * <br/>
    <input type="text" name="name"  value="<?=$user['name']?>" required="true" /></label>
    
    <label><br/>Email * <br/>
    <input type="text" name="email" value="<?=$user['email']?>" required="true" /></label>
    <br/>
    <input type='submit' name='doProfileSave' value='Spara profil' />


