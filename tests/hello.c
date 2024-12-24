#include "stdio.h"
#include "conio.h"
#include "iostream"

int main()
{
    char n, i, a;
    n=10;
    a=1;
    for (i=1;i<=n;i+=2) a=a*i;
    printf("%d",a);
    getch();
}