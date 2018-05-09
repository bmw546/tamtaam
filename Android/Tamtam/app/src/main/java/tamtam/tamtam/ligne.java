package tamtam.tamtam;

public class ligne {
    // setteur getteur
    int text;
    int message;
    int color;
    public ligne(int journe,  int mess, int color){
        this.settext(journe);
        this.setMessage(mess);
        this.setColor(color);
    }
    public int getText() {
        return text;
    }

    public void settext(int day) {
        this.text = day;
    }

    public int getColor() {
        return color;
    }

    public void setColor(int day) {
        this.color = day;
    }

    public int getMessage() {
        return message;
    }

    public void setMessage(int message) {
        this.message = message;
    }

}
