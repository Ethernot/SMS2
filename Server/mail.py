import sys
import smtplib

#obtains details about the email from the command
USER=sys.argv[1]
PASS=sys.argv[2]
SERVER=sys.argv[3]
RECIPIENT=sys.argv[4]

#subject comes with underscores between each string
SUBJECT=sys.argv[5]
SUBJECT=SUBJECT.replace('_',' ')

MESSAGE=sys.argv[6]
MESSAGE=MESSAGE.replace('_',' ')
PORT=sys.argv[7]

#sends the email message.returns true on success.
def send_email():
	    global USER
	    global PASS
	    global SERVER
	    global RECIPIENT
	    global SUBJECT
	    global MESSAGE
	    global PORT

            gmail_user = USER
            gmail_pwd = PASS
            FROM = USER
            TO = [RECIPIENT] #must be a list
            TEXT = MESSAGE

            # Prepare actual message
            message = """\From: %s\nTo: %s\nSubject: %s\n\n%s""" % (FROM, ", ".join(TO), SUBJECT, TEXT)

       
            server = smtplib.SMTP(SERVER, PORT) 
            server.ehlo()
            server.starttls()
            server.login(gmail_user, gmail_pwd)
            server.sendmail(FROM, TO, message)
            #server.quit()
            server.close()
            return "Email enviado!"

if __name__=='__main__':
    print send_email()



