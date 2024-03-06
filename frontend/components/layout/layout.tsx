'use client'

import Payment from "@/app/payment/page";
import { useLockedBody } from "@/src/hooks/useBodyLock";
import { Card, CardHeader, CardBody, CardFooter } from "@nextui-org/react";
import React from "react";

interface Props {
  children: React.ReactNode;
}

export const LayoutComponent = ({ children }: Props) => {
  const [sidebarOpen, setSidebarOpen] = React.useState(false);
  const [_, setLocked] = useLockedBody(false);
  const handleToggleSidebar = () => {
    setSidebarOpen(!sidebarOpen);
    setLocked(!sidebarOpen);
  };


  return (
    <Card shadow="sm" className="h-full">
      <CardBody>
        <Payment />
      </CardBody>
      <CardFooter></CardFooter>
    </Card>
  );
};
