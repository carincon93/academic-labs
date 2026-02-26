package add;

public class Add {
    public static int index = 0;
    public static void main(String[] args) {
        int[] array = new int[]{1,3,4};

        int add = add(array);

        System.out.println("result: "+add);
    }

    public static int add(int[] a) {
        if(index == a.length) {
            return 0;
        }
        index++;
        return a[index -1] + add(a);
    }
}
