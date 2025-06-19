import { Module } from "@nestjs/common";
import { HotelResolver } from "./hotel.resolver";

@Module({
    imports: [],
    controllers: [],
    providers: [HotelResolver],
})
export class HotelModule {}